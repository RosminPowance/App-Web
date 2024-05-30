<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Falcon | Dashboard &amp; Web App Template</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/vendors/simplebar/simplebar.min.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap'"
        rel="stylesheet">
    <link href="{{ asset('assets/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    @vite(['resources/js/app.js'])
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            @include('components.layouts.menu')

            <div class="content">
                {{ $slot }}
                <footer class="footer">
                    <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v3.19.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('assets/vendors/popper/popper.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/anchorjs/anchor.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/is/is.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/lodash/lodash.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/vendors/list.js/list.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/js/theme.js') }}" data-navigate-once></script>
</body>


</html>
