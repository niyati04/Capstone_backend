@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="original_price" required placeholder="Product Price" value="{{$product->original_price}}">
                                @if ($errors->has('original_price'))
                                    <div class="text-danger">{{ $errors->first('original_price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="select" name="category_id" required>
                                    <option>Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Casual Wear</label>
                                <select class="select" name="casual_wear" required>
                                    <option>Select</option>
                                    <option value="oversize" {{ $product->casual_wear == 'oversize' ? 'selected' : '' }}>
                                        Oversize</option>
                                    <option value="normal" {{ $product->casual_wear == 'normal' ? 'selected' : '' }}>Normal
                                    </option>
                                </select>
                                @if ($errors->has('casual_wear'))
                                    <div class="text-danger">{{ $errors->first('casual_wear') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Design By</label>
                                <select class="select" name="design_by" required>
                                    <option>Select</option>
                                    <option value="embroidery" {{ $product->design_by == 'embroidery' ? 'selected' : '' }}>
                                        Embroidery</option>
                                    <option value="graphic" {{ $product->design_by == 'graphic' ? 'selected' : '' }}>
                                        Graphic</option>
                                    <option value="regular" {{ $product->design_by == 'regular' ? 'selected' : '' }}>
                                        Regular</option>
                                </select>
                                @if ($errors->has('design_by'))
                                    <div class="text-danger">{{ $errors->first('design_by') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea type="text" name="description">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
