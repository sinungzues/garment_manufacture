<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'CLOUD')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Dashboard for Color Admin" name="description" />
    <meta content="Author Name" name="author" />

    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

    @include('layouts.css')
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
        integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
        crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed">
        <div id="header" class="app-header">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><span class="navbar-logo"></span>
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" srcset="">
                    <b class="me-3px">Clo</b>ud
                </a>
                <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-nav">
                <div class="navbar-item navbar-user dropdown">
                    <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center"
                        data-bs-toggle="dropdown">
                        @php
                            $randomNumber = session('randomNumber');
                            if (!$randomNumber) {
                                $randomNumber = rand(1, 14);
                                session(['randomNumber' => $randomNumber]);
                            }
                            $user = Auth::user();
                        @endphp
                        <img src="{{ asset('assets/img/user/user-' . $randomNumber . '.jpg') }}" alt="User Image" />
                        <span>
                            <span class="d-none d-md-inline">{{ $user->name }}</span>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end me-1">
                        <a href="/logout" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Log
                            Out</a>
                        <form id="logoutForm" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.sidebar')

        <div id="content" class="app-content">
            @yield('content')
        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>

    @include('layouts.js')
    <script>
        @if (session('notification'))
            Swal.fire({
                title: '{{ session('notification.title') }}',
                text: '{{ session('notification.message') }}',
                icon: '{{ session('notification.type') }}',
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                timer: 1500,
            });
        @endif

        @if (session('login'))
            $.gritter.add({
                title: '{{ session('login.title') }}',
                text: '{{ session('login.text') }}',
                image: '{{ session('login.image') }}',
                sticky: false,
                time: '{{ session('login.time') }}'
            });
        @endif
    </script>
</body>

</html>
