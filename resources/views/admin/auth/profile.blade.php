@extends('dashboard.layout.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Profile</h4>
                <h6>User Profile</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="profile-set">
                        <div class="profile-head">
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="img"
                                        id="blah">
                                    <div class="profileupload">
                                        <input type="file" id="imgInp">
                                        <a href="javascript:void(0);"><img
                                                src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img"></a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{ auth()->user()->name }}</h2>
                                    <h4>Updates Your Photo and Personal Details.</h4>
                                </div>
                            </div>
                            {{-- <div class="ms-auto">
                                <a href="javascript:void(0);" class="btn btn-submit me-2">Save</a>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="William" name="name" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="william@example.com" value="{{ auth()->user()->email }}"
                                    disabled>
                                <div id="emailHelp" class="form-text">You can't change email address.</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password_confirmation">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <div class="text-danger">{{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
