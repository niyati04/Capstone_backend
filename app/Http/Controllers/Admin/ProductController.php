<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductImage;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('admin.product.index', compact('data'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.create', compact('categories', 'colors', 'sizes'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'category_id' => 'required|exists:category,id',
                // 'image' => 'required|mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                return back()->with("errors", $validator->errors());
            }

            $product = [
                "name" => $request->name,
                "category_id" => $request->category_id,
                "casual_wear" => $request->casual_wear,
                "design_by" => $request->design_by,
                "description" => $request->description ? $request->description : NULL,
            ];

            DB::beginTransaction();
            $create = Product::create($product);
            if ($create) {
                if ($request->attribute) {
                    foreach ($request->attribute as $key => $value) {
                        if (isset($value['attr_image'])) {
                            $img = $value['attr_image'];
                            $imageName = time() . rand('111111111', '999999999') . '.' . $img->extension();
                            $img->move(public_path('images/product/'), $imageName);
                            // ProductImage::create([
                            //     'product_id' => $create->id,
                            //     'product_attr_id' => $prod_att->id,
                            //     'image' => $imageName,
                            // ]);
                        }
                        $prod_att = ProductAttr::create([
                            'product_id' => $create->id,
                            'original_price' => $value['original_price'],
                            'qty' => $value['qty'],
                            'sku' => str_replace(' ', '', trim(strtolower($request->name))) . "_" . time() . rand('111111', '9999999'),
                            'size_id' =>  $value['size_id'],
                            'image' =>  $imageName,
                        ]);
                    }
                }
                DB::commit();
                return redirect()->route('admin.product.index')->with('success', 'Product Successfully Created.');
            } else {
                DB::rollBack();
                return back()->with('error', 'Product Failed to Created');
            }
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            ProductAttr::where('product_id', $id)->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Product Attribute Deleted Successfully');
    }

    // product attribute functions-----------------------------------------------------------------------------------------------

    public function productAttributeList($id)
    {
        $product = Product::where('id', $id)->first('name');
        $data = ProductAttr::with(['productAttrImg', 'color', 'size'])->where('product_id', $id)->get();
        return view('admin.product-attribute.index', compact('data', 'product'));
    }

    public function productAttributeCreate($pro_id)
    {
        $product = Product::find($pro_id);
        $sizes = Size::all();
        return view('admin.product-attribute.create', compact('sizes', 'product'));
    }

    public function productAttributeStore(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'qty' => 'required',
            'size_id' => 'required',
            'attr_image' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $product = Product::find($request->product_id);
        if ($product) {
            $prod_att = new ProductAttr();
            $prod_att->product_id = $request->product_id;
            $prod_att->original_price = $request->price;
            $prod_att->qty = $request->qty;
            $prod_att->sku = str_replace(' ', '', trim(strtolower($product->name))) . "_" . time() . rand('111111', '9999999');
            $prod_att->size_id = $request->size_id;

            if ($request->hasFile('attr_image')) {
                $img = $request->attr_image;
                $imageName = time() . rand('111111111', '999999999') . '.' . $img->extension();
                $img->move(public_path('images/product/'), $imageName);
                $prod_att->image = $imageName;
            }
            $prod_att->save();
            return redirect()->route('admin.product.attribute', [$request->product_id])->with('success', 'Product Attribute Updated Successfully');
        } else {
            return back()->with('error', 'Product is not found.');
        }
    }

    public function productAttributeEdit($id)
    {
        $product_attribute = ProductAttr::find($id);
        $categories = Category::all();
        $sizes = Size::all();
        return view('admin.product-attribute.edit', compact('product_attribute', 'categories', 'sizes'));
    }

    public function productAttributeUpdate(Request $request, $id)
    {
        // dd($id, $request->all());
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'qty' => 'required',
            'size_id' => 'required',
            'attr_image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $prod_att = ProductAttr::where('id', $id)->first();
        if ($prod_att) {
            $prod_att->original_price = $request->price;
            $prod_att->qty = $request->qty;
            $prod_att->size_id = $request->size_id;

            if ($request->hasFile('attr_image')) {
                $img = $request->attr_image;
                $imageName = time() . rand('111111111', '999999999') . '.' . $img->extension();
                $img->move(public_path('images/product/'), $imageName);
                $prod_att->image = $imageName;
            }
            $prod_att->save();
            return redirect()->route('admin.product.attribute', [$prod_att->product_id])->with('success', 'Product Attribute Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Product Attribute Not Found');
        }
    }

    public function productAttributeDelete($id)
    {
        $prod_att = ProductAttr::where('id', $id)->first();
        $productId = $prod_att->product_id;
        if ($prod_att) {
            $prod_att->delete();
            return redirect()->route('admin.product.attribute', [$productId])->with('success', 'Product Attribute Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Product Attribute Not Found');
        }
    }

    public function productTranding(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            if ($product) {
                $product->is_tranding = $request->is_tranding;
                $product->save();
                $msg = $request->is_tranding == 1 ? 'set' : 'remove';
                return response()->json([
                    'data' => $request->is_tranding,
                    'status' => true,
                    'message' => "Product " . $msg . " on tranding successfully."
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "product not available."
                ]);
            }
        }
    }
    public function productStatus(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            if ($product) {
                $product->status = $request->status;
                $product->save();
                $msg = $request->status == 1 ? 'on' : 'off';
                return response()->json([
                    'data' => $request->status,
                    'status' => true,
                    'message' => "Product status " . $msg . " successfully."
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "product not available."
                ]);
            }
        }
    }
    public function productOutOfStock(Request $request)
    {
        if ($request->ajax()) {
            $product = ProductAttr::find($request->id);
            if ($product) {
                $product->out_of_stock = $request->out_of_stock;
                $product->save();
                $msg = $request->out_of_stock == 1 ? 'out of ' : 'in';
                return response()->json([
                    'data' => $request->out_of_stock,
                    'status' => true,
                    'message' => "Product is " . $msg . " stock."
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "product not available."
                ]);
            }
        }
    }
}
