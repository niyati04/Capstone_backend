@extends('admin.layout.layout')
@section('title', 'Coupon')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Coupon</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.coupon.update', $coupon) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}"
                                    placeholder="Coupon Code" required>
                            </div>
                            @if ($errors->has('coupon_code'))
                                <div class="text-danger">{{ $errors->first('coupon_code') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Coupon Discount</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="coupon_discount"
                                        value="{{ $coupon->coupon_discount }}" placeholder="Coupon Discount" required
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                            @if ($errors->has('coupon_discount'))
                                <div class="text-danger">{{ $errors->first('coupon_discount') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
