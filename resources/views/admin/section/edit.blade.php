@extends('admin.layout.layout')
@section('title', 'Section')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Section</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.section.update', $data) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Section Name</label>
                                <input type="text" name="name" placeholder="Section Name" required value="{{$data->name}}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Products</label>
                                <select multiple class="form-control select" name="product_ids[]" required>
                                    <option value="">Select products</option>
                                    @foreach ($product as $row)
                                        <option value="{{ $row->id }}"
                                            {{ in_array($row->id, explode(',', $data->product_ids)) ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
