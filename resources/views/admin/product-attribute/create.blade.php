@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add Attribute</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.attribute.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden value="{{ $product->id }}" name="product_id">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="card flex-fill bg-white">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Product Name:- {{ $product->name }}</h5>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Category :</strong>
                                        <p>{{ $product->category->name }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Casual Wear :</strong>
                                        <p>{{ Str::upper($product->casual_wear) }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Design by :</strong>
                                        <p>{{ Str::upper($product->design_by) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-8 col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <select class="select" name="color_id" required>
                                            <option>Select</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->color_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div id="dynamicMultiSize">
                                            <div class="row">
                                                <div class="col-lg-5 col-sm-5 col-5">
                                                    <label>Size</label>
                                                    <select class="select" name="sizes[0][size]" required>
                                                        <option value="">Select</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->size }}">{{ $size->size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-5 col-sm-5 col-5">
                                                    <label>Qty</label>
                                                    <input type="text" name="sizes[0][qty]" required
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
                                <div class="col-sm-6 col-12">
                                    <label>Product Images</label>
                                    <input id="image-uploadify" name="images[]" type="file" accept="image/*" multiple>
                                </div>
                                <div class="col-12 d-none">
                                    <label class="form-label">@lang('Image Preview')</label><br>
                                    <img src="#" alt="your image" width="70px" height="70px" />
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <div class="form-group">
                                <label>Attribute Images</label>
                                <input type="file" name="images[]" class="form-control" multiple accept="image/*" required>
                            </div>
                        </div> --}}
                        {{-- <div class="col-12">
                            <h6 class="mb-0">Products Images</h6>
                            <hr />
                            <input id="image-uploadify" name="images" type="file" accept="image/*" >
                        </div> --}}
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2">Add</button>
                            <a href="{{ url()->previous() }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     $("input[type='file']").change(function() {
        //         $(this).parent('div').parent('div').next('div').removeClass('d-none')
        //         var img = $(this).parent('div').parent('div').next('div').find('img');
        //         readURL(this, img); // this function is in layout file
        //     });
        // });
        $(document).ready(function() {
            var a = 0;
            $("#addMultiSize").click(function() {
                ++a;
                var html = $(`
                        <div class="row mt-2">
                            <div class="col-lg-5 col-sm-5 col-5">
                                <select class="select form-select" name="sizes[${a}][size]" required>
                                    <option value="">Select</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5 col-sm-5 col-5">
                                <input type="text" name="sizes[${a}][qty]" required
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
        });
    </script>
@endsection
