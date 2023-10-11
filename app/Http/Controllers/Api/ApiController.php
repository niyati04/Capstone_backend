<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\Size;
use App\Models\User;
use App\Models\WishList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function sendOtpOnMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return $this->success(false, $validator->errors()->first());
        } else {
            $otp = rand(100000, 999999);
            $hashOtp = Hash::make($otp);
            $email = $request->email;
            try {
                DB::beginTransaction();
                // Mail::to($email)->send(new OtpMail(["otp" => $otp, 'email' => $email]));
                $user = User::updateOrCreate(['email' => $request->email], ['otp' => $hashOtp, 'email' => $email]);
                if ($user) {
                    DB::commit();
                    return $this->success(true, "Otp send successfully.", ["otp" => $otp, 'email' => $email]);
                } else {
                    DB::rollBack();
                    return $this->error("Something wrong.");
                }
            } catch (Exception $th) {
                DB::rollBack();
                return $this->error($th->getMessage());
            }
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->success(false, $validator->errors()->first());
            } else {
                $user = User::where("email", $request->email)->first();
                // dd($request->all(), $user);
                if ($user && Hash::check($request->otp, $user->otp)) {
                    $user->update([
                        "otp" => null,
                        "email_verified_at" => date("Y-m-d H:i:s"),
                        'password' => Hash::make($request->password),
                    ]);
                    $token = JWTAuth::fromUser($user);
                    $user['token'] = $token;
                    return $this->success(true, "Register successfully.", $user);
                } else {
                    return $this->success(false, "Invalid OTP");
                }
            }
        } catch (Exception $th) {
            return $this->error($th->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:6|max:50'
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            } else {
                $user = User::where('email', $data['email'])->first();
                if (!$user) {
                    return $this->success(false, 'Invalid username or password');
                }
                $credentials = $request->only('email', 'password');
                if (!$token = JWTAuth::attempt($credentials)) {
                    return $this->success(false, 'Invalid email or password Credential');
                }
                $user['token'] = $token;
                return $this->success(true, "Login successfully.", $user);
            }
        } catch (\Exception $th) {
            return $this->error($th->getMessage());
        }
    }

    public function product(Request $request)
    {
        try {
            $product = Product::query();
            $product = $product->with(['productAttr', 'productAttr.size']);
            if ($request->search != null) {
                $product = $product->where('name', 'like', "%" . $request->search . "%");
            }
            if ($request->category != null) {
                $product = $product->where('category_id', $request->category);
            }
            if ($request->casual_wear != null) {
                $product = $product->where('casual_wear', $request->casual_wear);
            }
            if ($request->design_by != null) {
                $product = $product->where('design_by', $request->design_by);
            }
            if ($request->size != null) {
                $product = $product->whereHas('productAttr', function ($query) use ($request) {
                    $query->where('size_id', $request->size);
                });
            }
            if ($request->price_start != null && $request->price_end != null) {
                $product = $product->whereHas('productAttr', function ($query) use ($request) {
                    // $query->where('original_price', ">=", $request->price_start)->where('original_price', "<=", $request->price_end);
                    $query->whereBetween('original_price', [(int)$request->price_start, (int)$request->price_end]);
                });
            }

            if (!empty($request->sort_by)) {
                if ($request->sort_by == 'name' && ($request->sort_action == "ASC" || $request->sort_action == "DESC")) {
                    $product = $product->orderBy('name', $request->sort_action);
                } else if ($request->sort_by == 'price' && ($request->sort_action == "ASC" || $request->sort_action == "DESC")) {
                    $product = $product->orderByRaw("CAST(original_price AS DECIMAL(10,2)) " . $request->sort_action);
                } else if ($request->sort_by == 'latest' && ($request->sort_action == "ASC" || $request->sort_action == "DESC")) {
                    $product = $product->orderBy('created_at', $request->sort_action);
                }
            }

            $product = $product->orderBy('id', 'desc')->get();
            $data['total'] = count($product);
            $data['product'] = $product;
            if (count($product) > 0) {
                return $this->success(true, "Product get successfully.", $data);
            } else {
                return $this->success(true, "No record found.");
            }
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function productDetail($id, $sku)
    {
        $product = ProductAttr::with('product', 'size')->where('product_id', $id)->where('sku', $sku)->first();
        $product_variations = ProductAttr::with('size')->where('product_id', $id)->select('id', 'sku', 'size_id', 'product_id')->get();
        if ($product) {
            $data['data'] = $product;
            $data['variations'] = $product_variations;
            return $this->success(true, 'Product detail get successfully.', $data);
        } else {
            return $this->success(false, 'No data available.');
        }
    }

    public function categories(Request $request)
    {
        $data = Category::get();
        return $this->success(true, 'Category get successfully.', $data);
    }

    public function sizes(Request $request)
    {
        $data = Size::get();
        return $this->success(true, 'Sizes get successfully.', $data);
    }

    public function addWatchlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_attr_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->success(false, $validator->errors()->first());
        } else {
            $data = ProductAttr::where('id', $request->product_attr_id)->where('product_id', $request->product_id)->first();
            if ($data) {
                $check = WishList::where('product_attr_id', $request->product_attr_id)->where('product_id', $request->product_id)->first();
                if (!$check) {
                    $wishlist = new WishList();
                    $wishlist->user_id = auth()->user()->id;
                    $wishlist->product_attr_id = $request->product_attr_id;
                    $wishlist->product_id = $request->product_id;
                    $wishlist->save();
                    return $this->success(true, "product stored in watchlist successfully.", $wishlist);
                } else {
                    return $this->success(false, "Already in cart.");
                }
            }
            return $this->success(false, "Product not available.");
        }
    }

    public function getAllProductFromWatchlist(Request $request)
    {
        $data = WishList::with([
            'productAtt',
            'productAtt.size',
            'productAtt.product',
        ])->where('user_id', auth()->user()->id)->get();
        if ($data) {
            return $this->success(true, "Get all watchlist product.", $data);
        }
        return $this->success(false, "Products is not available.");
    }

    public function removeProductFromWatchlist($id)
    {
        $data = WishList::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if ($data) {
            $data->delete();
            return $this->success(true, "remove from cart.");
        }
        return $this->success(false, "Product not available.");
    }
}
