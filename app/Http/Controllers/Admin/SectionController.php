<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SectionWiseProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function index()
    {
        $data  = SectionWiseProduct::all();
        return view('admin.section.index', compact('data'));
    }

    public function create()
    {
        $product = Product::select('id', 'name')->get();
        return view('admin.section.create', compact('product'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'product_ids' => 'required',
            'product_ids.*' => 'exists:products,id',
        ]);

        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        } else {
            $section = new SectionWiseProduct();
            $section->name = $request->name;
            $section->product_ids = implode(',', $request->product_ids);
            $section->save();
            return redirect()->route('admin.section.index')->with('success', 'Section wise product added Successfully');
        }
    }

    public function edit(string $id)
    {
        $data = SectionWiseProduct::find($id);
        $product = Product::select('id', 'name')->get();
        return view('admin.section.edit', compact('data', 'product'));
    }

    public function update(Request $request, string $id)
    {
        $section = SectionWiseProduct::find($id);
        if ($section) {
            $section->name = $request->name;
            $section->product_ids = implode(',', $request->product_ids);
            $section->save();
            return redirect()->route('admin.section.index')->with('success', 'Section update successfully.');
        }
    }

    public function destroy(Request $request, string $id)
    {
        $section = SectionWiseProduct::find($id);
        if ($section) {
            $section->delete();
            return redirect()->route('admin.section.index')->with('success', 'Section successfully deleted.');
        }
        return back()->with('error', 'Section Failed to Deleted.');
    }
}
