@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Attribute</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.attribute.update', $product_attribute) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="card flex-fill bg-white">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Product Name:- {{ $product_attribute->product->name }}</h5>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Category :</strong>
                                        <p>{{ $product_attribute->product->category->name }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Casual Wear :</strong>
                                        <p>{{ Str::upper($product_attribute->product->casual_wear) }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Design by :</strong>
                                        <p>{{ Str::upper($product_attribute->product->design_by) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-8 col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $product_attribute->original_price }}" required>
                                        @if ($errors->has('price'))
                                            <div class="text-danger">{{ $errors->first('price') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" class="form-control" name="qty"
                                            value="{{ $product_attribute->qty }}" required>
                                        @if ($errors->has('qty'))
                                            <div class="text-danger">{{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <select class="select" name="size_id" required>
                                            <option>Select</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}"
                                                    {{ $size->id == $product_attribute->size_id ? 'selected' : '' }}>
                                                    {{ $size->size }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Attribute Image</label>
                                        <input type="file" class="form-control" name="attr_image" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">@lang('Image Preview')</label><br>
                                    <img src="" alt="your image" width="70px" height="70px" id="proAttImg" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
                {{-- <hr>
                <h5>Product Attribute Image</h5>
               <div class="row mt-2">
                    @foreach ($productAttributes->productAttrImg as $img)
                        <div class="col-1 position-relative">
                            <form action="{{ route('admin.product.attribute.img.remove', $img) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button style="all: unset; cursor: pointer;" class="position-absolute">
                                    <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" width="20">
                                </button>
                            </form>
                            <img src="{{ $img->image }}" alt=""
                                style="width: 100px; height: 100px; background-size:cover">
                        </div>
                    @endforeach
                </div> --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            if ("{{ $product_attribute->image }}") {
                console.log('ss');
                $('#proAttImg').attr('src', "{{ $product_attribute->image }}")
            }

            $("input[type='file']").change(function() {
                $(this).parent('div').parent('div').next('div').removeClass('d-none')
                var img = $(this).parent('div').parent('div').next('div').find('img');
                readURL(this, img); // this function is in layout file
            });
        });
    </script>
@endsection
