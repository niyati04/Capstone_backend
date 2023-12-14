@extends('admin.layout.layout')
@section('title', 'Testimonial')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add Testimonial</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.testimonial.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Client Name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" name="designation" placeholder="Client desgination">
                                @if ($errors->has('designation'))
                                    <div class="text-danger">{{ $errors->first('designation') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" id="" cols="30" rows="10" placeholder="Message"></textarea>
                                @if ($errors->has('message'))
                                    <div class="text-danger">{{ $errors->first('message') }}
                                    </div>
                                @endif
                            </div>
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
