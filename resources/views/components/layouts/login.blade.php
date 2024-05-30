<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sinarmas SPK">
    <meta name="keywords" content="Sinarmas SPK">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('images/pngegg.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/pngegg.ico') }}" type="image/x-icon">
    <title>Sinarmas SPK</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets-2/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/responsive.css') }}">
    @vite(['resources/js/app.js'])
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div class="text-center">
                            <a class="logo" href="{{ asset('index.html') }}"><img class="img-fluid for-light"
                                    src="{{ asset('assets-2/images/logo.gif') }}" alt="looginpage">
                            </a>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ asset('assets-2/js/jquery.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('assets-2/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('assets-2/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('assets-2/js/icons/feather-icon/feather-icon.js') }}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('assets-2/js/config.js') }}"></script>
        <!-- Plugins JS start-->
        <!-- calendar js-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets-2/js/script.js') }}"></script>
        <!-- Plugin used-->
    </div>
</body>

</html>
