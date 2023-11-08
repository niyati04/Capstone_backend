@extends('admin.layout.layout')
@section('title', 'Banner')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Banner list</h4>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.banner.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Banner
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
                </div>


                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Banner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            <img src="{{ $row->image }}" alt="product" width="80" height="50">
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin.banner.destroy', $row) }}"
                                            onsubmit="return confirm('Confirm delete?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="me-2" style="all: unset; cursor: pointer;">
                                                <i class="fe fe-trash-2" style="color: red" data-bs-toggle="tooltip"
                                                    title="Delete Size"></i>
                                            </button>
                                        </form>
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
