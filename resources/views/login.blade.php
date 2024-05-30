<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Color Admin | Login v2</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content name="description" />
    <meta content name="author" />

    @include('layouts.css')
</head>

<body class="pace-top">
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app">
        <div class="login login-v2 fw-bold">
            <div class="login-cover">
                <div class="login-cover-img"
                    style="
              background-image: url(assets/img/login-bg/login-bg-17.jpg);
            "
                    data-id="login-cover-image"></div>
                <div class="login-cover-bg"></div>
            </div>

            <div class="login-container">
                <div class="login-header">
                    <div class="brand">
                        <div class="d-flex align-items-center">
                            <span class="logo"></span> <b>Color</b> Admin
                        </div>
                        <small>Bootstrap 5 Responsive Admin Template</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <div class="login-content">
                    <form action="/login" method="post">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-floating mb-20px">
                            <input type="text" class="form-control fs-13px h-45px border-0" placeholder="Username"
                                id="username" name="username" autocomplete="off"/>
                            <label for="username"
                                class="d-flex align-items-center text-gray-600 fs-13px">Username</label>
                        </div>
                        <div class="form-floating mb-20px">
                            <input type="password" class="form-control fs-13px h-45px border-0" placeholder="Password"
                                name="password" />
                            <label for="emailAddress"
                                class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
                        </div>
                        <div class="mb-20px">
                            <button type="submit" class="btn btn-theme d-block w-100 h-45px btn-lg">
                                Sign me in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="login-bg-list clearfix">
            <div class="login-bg-list-item active">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-17.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-17.jpg') }});
            "></a>
            </div>
            <div class="login-bg-list-item">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-16.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-16.jpg') }});
            "></a>
            </div>
            <div class="login-bg-list-item">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-15.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-15.jpg') }});
            "></a>
            </div>
            <div class="login-bg-list-item">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-14.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-14.jpg') }});
            "></a>
            </div>
            <div class="login-bg-list-item">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-13.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-13.jpg') }});
            "></a>
            </div>
            <div class="login-bg-list-item">
                <a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg"
                    data-img="{{ asset('assets/img/login-bg/login-bg-12.jpg') }}"
                    style="
              background-image: url({{ asset('assets/img/login-bg/login-bg-12.jpg') }});
            "></a>
            </div>
        </div>


        <a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>

    @include('layouts.js')
    <script src="{{ asset('assets/js/demo/login-v2.demo.js') }}"></script>
</body>

</html>
