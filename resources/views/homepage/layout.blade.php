<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Libra</title>
    <link href="{{ secure_asset('/css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Inclusion of additional styles -->
    @yield('styles')
</head>
<body class="home-page">
    <header>
        <div class="logo-container">
            <div class="title-container"><h1>La Consolacion College Tanauan</h1></div>
            <div class="logo"><img src="{{ secure_asset('/images/logo.png') }}" alt="LCCT"></div>
        </div>
        <div class="nav">
            <ul class="nav-list">
                <li><a href="#">home</a></li>
                <li><a href="#">ulcc-sl</a></li>
                <li><a href="#">about us</a></li>
                <li><a href="#">our story</a></li>
                <li><a href="#">admission</a></li>
                <li><a href="#">gallery</a></li>
                <li><a href="#">contact us</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <div class="container">
            <ul>
                <li>La Consolacion College Tanauan Batangas, Philippines 4232</li>
                <li>
                    <ul>
                        <li>Admission Office: +63 (043)-778-1020 local 110</li>
                        <li>Registrar Office: +63 (043)-778-1020 local 109</li>
                        <li>Inquire: <a href="mailto:info@lcctanauan.edu.ph">info@lcctanauan.edu.ph</a></li>
                    </ul>
                </li>
                <li>All Rights Reserved 2017</li>
            </ul>
        </div>
    </footer>

    <script src="{{ secure_asset('js/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('js/config.js') }}"></script>
    <script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ secure_asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>
