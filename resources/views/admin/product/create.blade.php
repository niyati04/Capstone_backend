@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <style>
        .delete-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 3px 5px;
            cursor: pointer;
            font-size: 6px;
        }

        .delete-btn:hover {
            background: white;
            color: black;
        }
    </style>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add</h4>
            </div>
        </div>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" required placeholder="Product name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="original_price" required placeholder="Product Price">
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
                                        <option value="{{ $category->id }}">{{ $category->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="text-danger">{{ $errors->first('category_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Casual Wear</label>
                                <select class="select" name="casual_wear" required>
                                    <option>Select</option>
                                    <option value="oversize">Oversize</option>
                                    <option value="regular">Regular</option>
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
                    </div>
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
            <div class="card">
                <div class="card-body">
                    <div id="dynamic">
                        <div class="row">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="select" name="attribute[0][color_id]" required>
                                        <option value="">Select</option>
                                        @foreach ($colors as $color)
                                            <option style="background-image: {{ $color->color }}"
                                                value="{{ $color->id }}">
                                                {{ $color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <div id="dynamicMultiSize">
                                        <div class="row">
                                            <div class="col-lg-5 col-sm-5 col-5">
                                                <label>Size</label>
                                                <select class="select" name="attribute[0][sizes][0][size]" required>
                                                    <option value="">Select</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->size }}">
                                                            {{ $size->size }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-5 col-sm-5 col-5">
                                                <label>Quantity</label>
                                                <input type="text" name="attribute[0][sizes][0][qty]" required
                                                    placeholder="Quantity">
                                            </div>
                                            <div class="col-lg-2 col-sm-2 col-2 ps-0" style="margin-top: 28px">
                                                <div class="add-icon">
                                                    <a href="javascript:void(0);" id="addMultiSize"><img
                                                            src="{{ asset('assets/img/icons/plus1.svg') }}"
                                                            alt="img"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Attribute Image</label>
                                    <input type="file" class="form-control" id="imageInput" multiple
                                        name="attribute[0][attr_image][]" accept="image/*" required>
                                </div>
                                <div id="imagePreview" class="d-flex">
                                </div>
                                {{-- @error('attribute.0.attr_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                                @if ($errors->has('attribute.0.attr_image.0'))
                                    <div class="text-danger">{{ $errors->first('attribute.0.attr_image.0') }}</div>
                                @endif
                            </div>
                            {{-- <div class="col-sm-2 col-12 d-none">
                                                <label class="form-label">Image Preview</label><br>
                                                <img src="#" alt="your image" width="70px" height="70px" />
                                            </div> --}}
                            <div class="col-sm-1 col-12" style="margin-top: 28px">
                                <button type="button" id="add" class="btn btn-success">add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
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
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // $("input[type='file']").change(function() {
            //     console.log('ddd');
            //     $(this).parent('div').parent('div').next('div').removeClass('d-none')
            //     var img = $(this).parent('div').parent('div').next('div').find('img');
            //     readURL(this, img); // this function is in layout file
            // });

            // start product attribute multi imge preview and delete ------------------------------------------------------------------
            $('#imageInput').on('change', function(e) {
                var files = e.target.files;
                $('#imagePreview').html('');

                for (var i = 0; i < files.length; i++) {
                    console.log(i);
                    var file = files[i];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').append(`
                            <div class="image-container m-2" style="position: relative;">
                                <img src="${e.target.result}" alt="${file.name}" width="50px">
                                <button class="delete-btn">X</button>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#imagePreview').on('click', '.delete-btn', function() {
                $(this).closest('.image-container').remove();
            });
            // end product attribute multi imge preview and delete --------------------------------------------------------------------------------------

            // start - Product attribute multi size add and remove --------------------------------------------------------------------------------------
            var a = 0;
            $("#addMultiSize").click(function() {
                ++a;
                var html = $(`
                        <div class="row mt-2">
                            <div class="col-lg-5 col-sm-5 col-5">
                                <select class="select form-select" name="attribute[0][sizes][${a}][size]" required>
                                    <option value="">Select</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5 col-sm-5 col-5">
                                <input type="text" name="attribute[0][sizes][${a}][qty]" required
                                    placeholder="Quantity">
                            </div>
                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                <div class="add-icon">
                                    <a href="javascript:void(0);" id="removeMultiSize"><img
                                            src="{{ asset('assets/img/icons/minus.svg') }}"
                                            alt="img"></a>
                                </div>
                            </div>
                        </div>
                    `);

                html.find('#removeMultiSize').on('click', function() {
                    $(this).parent().parent().parent().remove();
                });

                $("#dynamicMultiSize").append(html);
            });
            // end - Product attribute multi size add and remove ----------------------------------------------------------------------------------------

            var i = 0;
            $("#add").click(function() {
                ++i;
                var html = $(`
                        <div class="row" id="product_${i}"><hr/>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="select form-select" name="attribute[${i}][color_id]" required>
                                        <option>Select</option>
                                        @foreach ($colors as $color)
                                            <option style="background-image: {{ $color->color }}"
                                                value="{{ $color->id }}">
                                                {{ $color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Size</label>
                                    <div id="dynamicMultiSize">
                                        <div class="row">
                                            <div class="col-lg-5 col-sm-5 col-5">
                                                <select class="select form-select" name="attribute[${i}][sizes][0][size]" required>
                                                    <option value="">Select</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->size }}">{{ $size->size }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-5 col-sm-5 col-5">
                                                <input type="text" name="attribute[${i}][sizes][0][qty]" required
                                                    placeholder="Quantity">
                                            </div>
                                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                                <div class="add-icon">
                                                    <a href="javascript:void(0);" id="addMultiSize"><img
                                                            src="{{ asset('assets/img/icons/plus1.svg') }}"
                                                            alt="img"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Attribute Image</label>
                                    <input type="file" name="attribute[${i}][attr_image][]" class="form-control" id="imageInput" multiple required accept="image/*" >
                                </div>
                                <div id="imagePreview" class="d-flex"></div>
                            </div>
                            <div class="col-sm-1 col-12" style="margin-top: 28px">
                                <button type="button" class="btn btn-danger remove-tr" onclick=remove("${i}")>Remove</button>
                            </div>
                        </div>
                    `);

                // html.find('input[type="file"]').on('change', function() {
                //     $(this).parent('div').parent('div').next('div').removeClass('d-none')
                //     var img = $(this).parent('div').parent('div').next('div').find('img');
                //     readURL(this, img); // this function is in layout file
                // });

                html.find(`#imageInput`).change(function(e) {
                    console.log('in');
                    var files = e.target.files;
                    html.find('#imagePreview').html('');

                    for (var i = 0; i < files.length; i++) {
                        console.log(i);
                        var file = files[i];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            html.find('#imagePreview').append(`
                                <div class="image-container m-2" style="position: relative;">
                                    <img src="${e.target.result}" alt="${file.name}" width="50px">
                                    <button class="delete-btn">X</button>
                                </div>
                            `);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Delete image when the delete button is clicked
                html.find('#imagePreview').on('click', '.delete-btn', function() {
                    $(this).closest('.image-container').remove();
                });

                var a = 0;
                html.find(`#addMultiSize`).click(function() {
                    ++a;
                    var htmlMultiSize = $(`
                        <div class="row mt-2">
                            <div class="col-lg-5 col-sm-5 col-5">
                                <select class="select form-select" name="attribute[${i}][sizes][${a}][size]" required>
                                    <option value="">Select</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5 col-sm-5 col-5">
                                <input type="text" name="attribute[${i}][sizes][${a}][qty]" required
                                    placeholder="Quantity">
                            </div>
                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                <div class="add-icon">
                                    <a href="javascript:void(0);" id="removeMultiSize"><img
                                            src="{{ asset('assets/img/icons/minus.svg') }}"
                                            alt="img"></a>
                                </div>
                            </div>
                        </div>
                    `);

                    htmlMultiSize.find('#removeMultiSize').on('click', function() {
                        $(this).parent().parent().parent().remove();
                    });

                    html.find("#dynamicMultiSize").append(htmlMultiSize);
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
