<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        $data = Color::all();
        return view('admin.color.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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
            'color' => 'required|unique:color,color',
            'color_name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $color = Color::create($request->all());
        if ($color) {
            return redirect()->route('admin.color.index')->with('success', 'Color Successfully Created.');
        }
        return back()->with('error', 'Color Failed to Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);
        return view('dashboard.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'color' => 'required|unique:color,color',
            'color_name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $color = Color::find($id);
        if ($color) {
            $color->update($request->all());
            return redirect()->route('admin.color.index')->with('success', 'Color Successfully Updated.');
        }
        return back()->with('error', 'Color Failed to Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        if ($color) {
            $color->forceDelete();
            return redirect()->route('admin.color.index')->with('success', 'Color Successfully Deleted.');
        }
        return back()->with('error', 'Color Failed to Deleted');
    }
}
