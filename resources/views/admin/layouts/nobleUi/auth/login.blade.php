<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('nobleUi')}}/assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('nobleUi')}}/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{asset('nobleUi')}}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('nobleUi')}}/assets/css/demo_2/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('nobleUi')}}/assets/images/favicon.png" />
</head>
<body>

<style>
    .auth-page .auth-left-wrapper {
        background-image: url("{{ asset('nobleUi/assets/images/login.png') }}");
    }
</style>

<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pr-md-0">
                                <div class="auth-left-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 pl-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Global<span>Excellence</span></a>
                                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                                    <form action="{{ route('admin.login.submit') }}" method="post" class="forms-sample">
                                            @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                                                   id="exampleInputEmail1"
                                                   placeholder="Email">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror"
                                                   id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                                Remember me
                                            </label>
                                        </div>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</button>
                                            {{--
                                            <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                                <i class="btn-icon-prepend" data-feather="twitter"></i>
                                                Login with twitter
                                            </button>
                                            --}}
                                        </div>
                                        {{--
                                        <a href="register.html" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                                        --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- core:js -->
<script src="{{asset('nobleUi')}}/assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('nobleUi')}}/assets/vendors/feather-icons/feather.min.js"></script>
<script src="{{asset('nobleUi')}}/assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<!-- end custom js for this page -->
</body>
</html>