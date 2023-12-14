<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::all();
        return view('admin.coupon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'coupon_code' => 'required',
            'coupon_discount' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $coupon_code = Str::upper(str_replace(' ', '', $request->coupon_code));
        $coupon_discount = $request->coupon_discount;
        $coupon_exists = Coupon::where([
            'coupon_code' => $coupon_code,
            'coupon_discount' => $coupon_discount,
        ])->first();
        if ($coupon_exists) {
            return back()->with('error', 'coupon already available.');
        }
        $coupon = Coupon::create([
            'coupon_code' => $coupon_code,
            'coupon_discount' => $coupon_discount,
        ]);
        if ($coupon) {
            return redirect()->route('admin.coupon.index')->with('success', 'coupon Successfully Created.');
        }
        return back()->with('error', 'coupon Failed to Created');
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
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
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
            'coupon_code' => 'required',
            'coupon_discount' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $coupon_code = Str::upper(str_replace(' ', '', $request->coupon_code));
        $coupon_discount = $request->coupon_discount;
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon_exists = Coupon::where([
                'coupon_code' => $coupon_code,
                'coupon_discount' => $coupon_discount,
            ])->first();
            if ($coupon_exists) {
                return back()->with('error', 'coupon already available.');
            } else {
                $coupon->coupon_code = $coupon_code;
                $coupon->coupon_discount = $coupon_discount;
                $coupon->save();
                return redirect()->route('admin.coupon.index')->with('success', 'coupon update Successfully.');
            }
        } else {
            return back()->with('error', 'coupon Failed to updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Coupon::find($id);
        if ($size) {
            $size->delete();
            return redirect()->route('admin.coupon.index')->with('success', 'coupon Successfully Deleted.');
        }
        return back()->with('error', 'coupon Failed to Deleted');
    }

    public function couponStatus(Request $request)
    {
        if ($request->ajax()) {
            $coupon = Coupon::find($request->id);
            if ($coupon) {
                $coupon->status = $request->status;
                $coupon->save();
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
}
