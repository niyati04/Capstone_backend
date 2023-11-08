<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index()
    {
        $data  = Testimonial::all();
        return view('admin.testimonial.index', compact('data'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        } else {
            $testimonial = new Testimonial();
            $testimonial->name = $request->name ?? null;
            $testimonial->message = $request->message ?? null;
            $testimonial->designation = $request->designation;
            if ($request->hasFile('image')) {
                $imageName = time() . rand('111111111', '999999999') . '.' . $request->image->extension();
                $request->image->move(public_path('images/testimonial'), $imageName);
                $testimonial->image = $imageName;
            }
            $testimonial->save();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial added Successfully');
        }
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Testimonial::find($id);
        return view('admin.testimonial.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $testimonial->name = $request->name ?? null;
            $testimonial->message = $request->message ?? null;
            $testimonial->designation = $request->designation;
            if ($request->hasFile('image')) {
                $imageName = time() . rand('111111111', '999999999') . '.' . $request->image->extension();
                $request->image->move(public_path('images/testimonial'), $imageName);
                $testimonial->image = $imageName;
            }
            $testimonial->save();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial update successfully.');
        }
    }

    public function destroy(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $testimonial->delete();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial successfully deleted.');
        }
        return back()->with('error', 'Testimonial Failed to Deleted.');
    }
}
