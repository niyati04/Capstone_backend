@extends('admin.layout.layout')
@section('title', 'Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product list</h4>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.product.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Product
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        {{-- <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                            </a>
                        </div> --}}
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                    alt="img"></a>
                        </div>
                    </div>
                    {{-- <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a>
                            </li>
                        </ul>
                    </div> --}}
                </div>

                {{-- <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Sub Category</option>
                                        <option>Fruits</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Sub Brand</option>
                                        <option>Iphone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img
                                            src="{{ asset('assets/img/icons/search-whites.svg') }}" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Sr.No</th>
                                {{-- <th>Image</th> --}}
                                <th>Name</th>
                                <th>Casual wear</th>
                                <th>Design By</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Is Tranding</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    {{-- <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            <img src="{{ $row->images[0]->image }}" alt="product">
                                        </a>
                                    </td> --}}
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->casual_wear }}</td>
                                    <td>{{ $row->design_by }}</td>
                                    <td>{{ $row->original_price }}</td>
                                    <td>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input data-id="{{ $row->id }}" type="checkbox"
                                                id="status_{{ $row->id }}" class="check status"
                                                {{ $row->status == 1 ? 'checked' : '' }}>
                                            <label for="status_{{ $row->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input data-id="{{ $row->id }}" id="tranding_{{ $row->id }}"
                                                type="checkbox" class="check tranding"
                                                {{ $row->is_tranding ? 'checked' : '' }}>
                                            <label for="tranding_{{ $row->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="d-flex">
                                        <a class="me-3" href="{{ route('admin.product.attribute', $row) }}" title="Product Attribute">
                                            <i class="fe fe-layers" data-bs-toggle="tooltip" title="Product Attributes"></i>
                                        </a>
                                        <a class="me-3" href="{{ route('admin.product.edit', $row) }}"
                                            title="Edit product">
                                            <i class="fe fe-edit-3" data-bs-toggle="tooltip" title="Edit Product"></i>
                                        </a>
                                        <div style="margin-top: -3px;" class="me-3">
                                            <form method="post" action="{{ route('admin.product.destroy', $row) }}"
                                                onsubmit="return confirm('If you delete product than also will be deleted their variation product. Confirm delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="all: unset; cursor: pointer;"
                                                    title="Delete product">
                                                    <i class="fe fe-trash-2" style="color: red" data-bs-toggle="tooltip"
                                                        title="Delete Product"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- <a class="me-3 confirm-text" href="javascript:void(0);">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tranding').change(function() {
                var tranding = $(this).prop('checked') == true ? 1 : 0
                var product_id = $(this).data('id')

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.product.tranding') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'is_tranding': tranding,
                        'id': product_id,
                    },
                    success: function(res) {
                        if (res.status) {
                            if (res.data == 1) {
                                var successHtml =
                                    '<div class="alert alert-dismissible fade show alert-success m-4 text-center" style="padding: 5px 10px;">' +
                                    '<p class="m-0">' +
                                    res.message + '</p></div>';
                            } else {
                                var successHtml =
                                    '<div class="alert alert-dismissible fade show alert-danger m-4 text-center" style="padding: 5px 10px;">' +
                                    '<p class="m-0">' +
                                    res.message + '</p></div>';
                            }
                            $('.messages').html(successHtml);
                        }
                    },
                    error: function(res) {
                        alert('Something went wrong');
                    }
                })
            })

            $('.status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0
                var product_id = $(this).data('id')

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.product.status') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'status': status,
                        'id': product_id,
                    },
                    success: function(res) {
                        if (res.status) {
                            if (res.data == 1) {
                                var successHtml =
                                    '<div class="alert alert-dismissible fade show alert-success m-4 text-center" style="padding: 5px 10px;">' +
                                    '<p class="m-0">' +
                                    res.message + '</p></div>';
                            } else {
                                var successHtml =
                                    '<div class="alert alert-dismissible fade show alert-danger m-4 text-center" style="padding: 5px 10px;">' +
                                    '<p class="m-0">' +
                                    res.message + '</p></div>';
                            }
                            $('.messages').html(successHtml);
                        }
                    },
                    error: function(res) {
                        alert('Something went wrong');
                    }
                })
            })
        })
    </script>
@endsection
