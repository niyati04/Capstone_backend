@extends('admin.layout.layout')
@section('title', 'Size')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Size</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.size.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text" name="size">
                                @if ($errors->has('size'))
                                    <div class="text-danger">{{ $errors->first('size') }}</div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-lg-12">
                            <div class="form-group">
                                <label> Product Image</label>
                                <div class="image-upload">
                                    <input type="file">
                                    <div class="image-uploads">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('admin.size.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
