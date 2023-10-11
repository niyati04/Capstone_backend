@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="select" name="category_id" required>
                                    <option>Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="text-danger">{{ $errors->first('category_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Casual Wear</label>
                                <select class="select" name="casual_wear" required>
                                    <option>Select</option>
                                    <option value="oversize">Oversize</option>
                                    <option value="normal">Normal</option>
                                </select>
                                @if ($errors->has('casual_wear'))
                                    <div class="text-danger">{{ $errors->first('casual_wear') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Design By</label>
                                <select class="select" name="design_by" required>
                                    <option>Select</option>
                                    <option value="embroidery">Embroidery</option>
                                    <option value="graphic">Graphic</option>
                                    <option value="regular">Regular</option>
                                </select>
                                @if ($errors->has('design_by'))
                                    <div class="text-danger">{{ $errors->first('design_by') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Featured Image</label>
                                <input type="file" class="form-control" name="image" onchange="readURL(this);" accept="image/*"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none" id="imagePreview">
                            <label class="form-label">@lang('Image Preview')</label><br>
                            <img id="featuredImage" src="#" alt="your image" width="70px" height="70px" />
                        </div> --}}
                        <hr>
                        <h4 class="mb-3 ml-2">Product Variation</h4>
                        <div id="dynamic">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" name="attribute[0][original_price]" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="text" name="attribute[0][qty]" required>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label>Color</label>
                                                <select class="select" name="attribute[0][color_id]">
                                                    <option>Select</option>
                                                    @foreach ($colors as $color)
                                                        <option style="background-image: {{ $color->color }}"
                                                            value="{{ $color->id }}">
                                                            {{ $color->color_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <select class="form-control" name="attribute[0][size_id]">
                                                    <option disabled selected>Select</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}">{{ $size->size }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Attribute Image</label>
                                                <input type="file" class="form-control" name="attribute[0][attr_image]"
                                                    accept="image/*" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 d-none">
                                            <label class="form-label">@lang('Image Preview')</label><br>
                                            <img src="#" alt="your image" width="70px" height="70px" />
                                        </div>
                                    </div>
                                    <button type="button" id="add" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="description" required></textarea>
                            </div>
                            @if ($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        {{-- <div class="col-12">
                            <h6 class="mb-0">Products Images</h6>
                            <hr />
                            <input id="image-uploadify" name="product_images[]" type="file" accept="image/*" multiple>
                        </div> --}}
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            $("input[type='file']").change(function() {
                console.log('ddd');
                $(this).parent('div').parent('div').next('div').removeClass('d-none')
                var img = $(this).parent('div').parent('div').next('div').find('img');
                readURL(this, img); // this function is in layout file
            });

            var i = 0;

            $("#add").click(function() {
                ++i;
                var html = $(`
                    <div class="card" id="product_${i}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 col-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="attribute[${i}][original_price]" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class="form-group">
                                        <label>Qty.</label>
                                        <input type="text" name="attribute[${i}][qty]" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <select name="attribute[${i}][size_id]" class="form-control" required>
                                            <option selected>Select</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Attribute Image</label>
                                        <input type="file" name="attribute[${i}][attr_image]" class="form-control" required accept="image/*" >
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12 d-none">
                                    <label class="form-label">@lang('Image Preview')</label><br>
                                    <img src="#" alt="your image" width="70px" height="70px" />
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger remove-tr" onclick=remove("${i}")>Remove</button>
                        </div>
                    </div>`);

                html.find('input[type="file"]').on('change', function() {
                    $(this).parent('div').parent('div').next('div').removeClass('d-none')
                    var img = $(this).parent('div').parent('div').next('div').find('img');
                    readURL(this, img); // this function is in layout file
                });

                $("#dynamic").append(html);

            });

            $('#customSwitches').on('change', function() {
                $('.extra').toggleClass('d-none')
            })
        })

        function remove(id) {
            jQuery('#product_' + id).remove();
        }
    </script>
@endsection
