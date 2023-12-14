@extends('admin.layout.layout')
@section('title', 'Banner')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add Banner</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Banner Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                            </div>
                            @if ($errors->has('image'))
                                <div class="text-danger">{{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12 d-none">
                            <label class="form-label">Image Preview</label><br>
                            <img id="featuredImage" src="#" alt="your image" width="80px" />
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("input[type='file']").change(function() {
                $(this).parent('div').parent('div').next('div').removeClass('d-none')
                var img = $(this).parent('div').parent('div').next('div').find('img');
                readURL(this, img); // this function is in layout file
            });
        });
    </script>
@endsection
