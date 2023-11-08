@extends('admin.layout.layout')
@section('title', 'Category')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add Category</h4>
                <h6>Create new product Category</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug">
                                @if ($errors->has('slug'))
                                    <div class="text-danger">{{ $errors->first('slug') }}
                                    </div>
                                @endif
                            </div>
                        </div> --}}
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
                            <a href="{{ route('admin.category.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
