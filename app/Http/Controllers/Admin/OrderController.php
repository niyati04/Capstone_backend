<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $api;

    public function __construct()
    {
        // $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    public function index()
    {
        $data = Order::with('orderDetail')->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('data'));
    }


    public function fetchDetail($payment_id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = $this->api->payment->fetch($payment_id);
        $order_detail = Order::with('orderDetail')->where('razorpay_payment_id', $id)->first();
        // $order_detail['payment_details'] = $data;
        $order_log = OrderLog::where('order_id', $order_detail->id)->get();
        return view('dashboard.order.show', compact('order_detail', 'order_log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = Order::find($id);
        if ($order) {
            $order->order_status = $request->status;
            $order->save();
            $order_log = OrderLog::where('order_id', $id)->where('status', $order->order_status)->first();
            if (!$order_log) {
                $log = new OrderLog();
                $log->order_id = $id;
                $log->status = $request->status;
                $log->save();
            }
            if ($request->status == 'placed') {
                OrderLog::where('order_id', $id)->delete();
            }
            return redirect()->back()->with('success', 'Order ' . $request->status . ' updated successfully');
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
        //
    }
}
