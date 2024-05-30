<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Dashboard for Color Admin" name="description" />
    <meta content="Author Name" name="author" />

    @include('layouts.css')
</head>

<body>
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed">
        <div id="header" class="app-header">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><span class="navbar-logo"></span>
                    <b class="me-3px">Color</b> Admin</a>
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
                        <img src="../assets/img/user/user-13.jpg" alt />
                        <span>
                            <span class="d-none d-md-inline">Adam Schwartz</span>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end me-1">
                        <a href="extra_profile.html" class="dropdown-item">Edit Profile</a>
                        <a href="email_inbox.html" class="dropdown-item d-flex align-items-center">
                            Inbox
                            <span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
                        </a>
                        <a href="calendar.html" class="dropdown-item">Calendar</a>
                        <a href="extra_settings_page.html" class="dropdown-item">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="login.html" class="dropdown-item">Log Out</a>
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
</body>

</html>
