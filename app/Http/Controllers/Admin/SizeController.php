<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function index()
    {
        $data = Size::all();
        return view('admin.size.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
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
            'size' => 'required|unique:size,size',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $size = Size::create($request->all());
        if ($size) {
            return redirect()->route('admin.size.index')->with('success', 'Size Successfully Created.');
        }
        return back()->with('error', 'Size Failed to Created');
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
        $size = Size::find($id);
        return view('admin.size.edit', compact('size'));
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
            'size' => 'required|unique:size,size',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $size = Size::find($id);
        if ($size) {
            $size->update($request->all());
            return redirect()->route('admin.size.index')->with('success', 'Size Successfully Updated.');
        }
        return back()->with('error', 'Size Failed to Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        if ($size) {
            $size->forceDelete();
            return redirect()->route('admin.size.index')->with('success', 'Size Successfully Deleted.');
        }
        return back()->with('error', 'Size Failed to Deleted');
    }
}
