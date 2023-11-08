<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Register</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/company_logo/Icon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-img">
                    <img src="{{ asset('assets/img/login.jpg') }}" alt="img">
                </div>
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('assets/img/company_logo/Fulllogotr2.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                        </div>
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.create') }}" method="POST" >
                            @csrf
                            <div class="form-login">
                                <label>Full Name</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your full name" name="name"
                                        value="{{ old('name') }}">
                                    <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img">
                                </div>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="email" placeholder="Enter your email address" name="email"
                                        value="{{ old('email') }}">
                                    <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
                                </div>
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="Enter your password"
                                        value="{{ old('password') }}" name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-inputs" placeholder="Enter your confirm password"
                                        value="{{ old('cpassword') }}" name="cpassword">
                                    <span class="fas toggle-passwords fa-eye-slash"></span>
                                </div>
                                @if ($errors->has('cpassword'))
                                    <div class="text-danger">{{ $errors->first('cpassword') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign Up</button>
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="{{ route('admin.login') }}" class="hover-a">Sign In</a></h4>
                        </div>
                        {{-- <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="assets/img/icons/google.png" class="me-2" alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="assets/img/icons/facebook.png" class="me-2" alt="google">
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
