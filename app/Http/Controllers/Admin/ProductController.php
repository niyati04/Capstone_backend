<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttrMultiSize;
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
                'casual_wear' => 'required',
                'design_by' => 'required',
                'original_price' => 'required',
                // 'image' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
            if ($validator->fails()) {
                return back()->with("errors", $validator->errors());
            }

            $product = [
                "name" => $request->name,
                "category_id" => $request->category_id,
                "casual_wear" => $request->casual_wear,
                "design_by" => $request->design_by,
                "original_price" => $request->original_price,
                "description" => $request->description ? $request->description : NULL,
            ];

            DB::beginTransaction();
            $create = Product::create($product);
            if ($create) {
                if ($request->attribute) {
                    foreach ($request->attribute as $key => $value) {
                        $prod_att = ProductAttr::create([
                            'product_id' => $create->id,
                            'sku' => strtotime(now()) . rand('111111', '9999999'),
                            'color_id' => $value['color_id'],
                        ]);

                        foreach ($value['sizes'] as $key => $row) {
                            $prod_att_multi_size = ProductAttrMultiSize::create([
                                'product_id' => $create->id,
                                'product_attr_id' => $prod_att->id,
                                'size' => $row['size'],
                                'qty' =>  $row['qty'],
                            ]);
                        }

                        foreach ($value['attr_image'] as $key => $img) {
                            $imageName = time() . rand('111111111', '999999999') . '.' . $img->extension();
                            $img->move(public_path('images/product'), $imageName);
                            ProductImage::create([
                                'product_id' => $create->id,
                                'product_attr_id' => $prod_att->id,
                                'image' => $imageName,
                            ]);
                        }
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'original_price' => 'required',
            'category_id' => 'required|exists:category,id',
            'casual_wear' => 'required',
            'design_by' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->casual_wear = $request->casual_wear;
            $product->design_by = $request->design_by;
            $product->original_price = $request->original_price;
            $product->description = $request->description ? $request->description : NULL;
            $product->save();
            return redirect()->route('admin.product.index')->with('success', 'Product Successfully Updated.');
        } else {
            return redirect()->back()->with('error', 'Product Attribute Not Found');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            ProductAttr::where('product_id', $id)->delete();
            ProductImage::where('product_id', $id)->delete();
            ProductAttrMultiSize::where('product_id', $id)->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Product Attribute Deleted Successfully');
    }

    // product attribute functions-----------------------------------------------------------------------------------------------

    public function productAttributeList($id)
    {
        $product = Product::where('id', $id)->first('name');
        $data = ProductAttr::with(['productAttrImg', 'color'])->where('product_id', $id)->get();
        return view('admin.product-attribute.index', compact('data', 'product'));
    }

    public function productAttributeCreate($pro_id)
    {
        $product = Product::find($pro_id);
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.product-attribute.create', compact('sizes', 'product', 'colors'));
    }

    public function productAttributeStore(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'color_id' => 'required',
            'sizes' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp'
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $product = Product::find($request->product_id);
        try {
            DB::beginTransaction();
            $prod_att = new ProductAttr();
            $prod_att->product_id = $request->product_id;
            $prod_att->sku = strtotime(now()) . rand('111111', '9999999');
            $prod_att->color_id = $request->color_id;
            $prod_att->save();

            if (count($request->sizes) > 0) {
                foreach ($request->sizes as $value) {
                    $prod_att_multi_size = ProductAttrMultiSize::create([
                        'product_id' => $request->product_id,
                        'product_attr_id' => $prod_att->id,
                        'size' => $value['size'],
                        'qty' =>  $value['qty'],
                    ]);
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->images as $key => $img) {
                    $imageName = time() . rand('111111111', '999999999') . '.' . $img->extension();
                    $img->move(public_path('images/product'), $imageName);
                    ProductImage::create([
                        'product_id' => $request->product_id,
                        'product_attr_id' => $prod_att->id,
                        'image' => $imageName,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.product.attribute', [$prod_att->product_id])->with('success', 'Product Attribute Updated Successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
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
            'attr_image' => 'nullable|image|mimes:jpeg,png,jpg,webp'
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
