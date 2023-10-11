@extends('admin.layout.layout')
@section('title', 'Color')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Color</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.color.store') }}" method="post">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Color</label>
                                <input type="color" name="color">
                                @if ($errors->has('color'))
                                    <div class="text-danger">{{ $errors->first('color') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Color Name</label>
                                <input type="text" name="color_name">
                                @if ($errors->has('color_name'))
                                    <div class="text-danger">{{ $errors->first('color_name') }}</div>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <input type="color" name="color">
                                    </span>
                                    <input type="text" class="form-control" name="color_name" placeholder="Enter Color name....">
                                </div>
                                <span class="text-muted">* Give the correct color name for the color you choose.*</span>
                                @if ($errors->has('color_name'))
                                    <div class="text-danger">{{ $errors->first('color_name') }}</div>
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
                            <a href="{{ route('admin.color.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
