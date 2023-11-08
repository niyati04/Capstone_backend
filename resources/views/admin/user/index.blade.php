@extends('admin.layout.layout')
@section('title', 'Users')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Users list</h4>
            </div>
            {{-- <div class="page-btn">
                <a href="{{ route('admin.size.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Size
                </a>
            </div> --}}
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
                                <th>Email</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td class="d-flex">
                                        <div>
                                            <form method="post" action="{{ route('admin.user.destroy', $row) }}"
                                                onsubmit="return confirm('Confirm delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="me-2" style="all: unset; cursor: pointer;">
                                                    <i class="fe fe-trash-2" style="color: red" data-bs-toggle="tooltip"
                                                        title="Delete Size"></i>
                                                </button>
                                            </form>
                                        </div>
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
