<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div
                    class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white d-flex flex-column justify-content-center ">
                    <div class="m-3 p-4  ">
                        <div class="d-flex align-items-center  mb-5">
                            <img src="{{ asset('img/logo-lms.png') }}" alt="logo" width="80"
                                class="shadow-light rounded-circle ">
                            <h2 class="text-dark font-weight-normal ml-4">CBT Admin Kejari
                            </h2>
                        </div>


                        <form method="post" action="/reset-password-action" class="needs-validation" novalidate="">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="email" type="hidden" class="form-control" name="email" tabindex="2"
                                    required hidden value="{{ $user->email }}">
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="confirm_password" class="control-label">Confirm Password</label>
                                </div>
                                <input id="confirm_password" type="password" class="form-control"
                                    name="confirm_password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div> --}}

                            <div class="form-group ">
                                {{-- <a href="auth-forgot-password.html" class="float-left mb-3">
                                    Forgot Password?
                                </a> --}}
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right w-100 "
                                    tabindex="4">
                                    Submit
                                </button>
                            </div>
                            {{-- 
                            <div class="mt-5 text-center">
                                Don't have an account? <a href="auth-register.html">Create new one</a>
                            </div> --}}
                        </form>


                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="{{ asset('img/unsplash/login-bg.png') }}">
                    {{-- <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="display-4 font-weight-bold mb-2">Good Morning</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                            </div>
                            Photo by <a class="text-light bb" target="_blank"
                                href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a
                                class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
