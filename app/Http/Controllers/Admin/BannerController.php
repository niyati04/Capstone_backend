<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::all();
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,webp,jpeg',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $banner = new Banner();
        if ($request->hasFile('image')) {
            $imageName = time() . rand('111111111', '999999999') . '.' . $request->image->extension();
            $request->image->move(public_path('images/banner'), $imageName);
            $banner->image = $imageName;
        }
        $banner->save();
        if ($banner) {
            return redirect()->route('admin.banner.index')->with('success', 'Banner Successfully Created.');
        }
        return back()->with('error', 'Banner Failed to Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $color = Banner::find($id);
    //     return view('dashboard.color.edit', compact('color'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'color' => 'required|unique:color,color',
    //         'color_name' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         return back()->with("errors", $validator->errors());
    //     }
    //     $color = Banner::find($id);
    //     if ($color) {
    //         $color->update($request->all());
    //         return redirect()->route('admin.color.index')->with('success', 'Color Successfully Updated.');
    //     }
    //     return back()->with('error', 'Color Failed to Updated');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Banner::find($id);
        if ($color) {
            $color->forceDelete();
            return redirect()->route('admin.color.index')->with('success', 'Color Successfully Deleted.');
        }
        return back()->with('error', 'Color Failed to Deleted');
    }
}
