@extends('admin.layout.layout')
@section('title', 'Testimonial')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Testimonial list</h4>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.testimonial.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Testimonial
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
                    <table class="table datanew">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>No.</th>
                                <th>Name</th>
                                <th>Designation</th>
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
                                    {{-- <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ asset('assets/img/product/noimage.png') }}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Computers</a>
                                </td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->designation }}</td>
                                    <td class="d-flex">
                                        <a class="me-3" href="{{ route('admin.testimonial.edit', $row) }}">
                                            <i class="fe fe-edit-3" data-bs-toggle="tooltip" title="Edit"></i>
                                        </a>
                                        <div>
                                            <form method="post" action="{{ route('admin.testimonial.destroy', $row) }}"
                                                onsubmit="return confirm('Confirm delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="me-2" style="all: unset; cursor: pointer;">
                                                    <i class="fe fe-trash-2" style="color: red" data-bs-toggle="tooltip"
                                                        title="Delete"></i>
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
@endsection
