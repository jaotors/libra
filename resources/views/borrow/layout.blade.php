<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Libra</title>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="topnav">
                <h1 class="logo"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="LCCT"></a></h1>
                <ul class="nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Books</a></li>
                    <li><a href="#">Resrvation</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
            <div class="main fullwidth borrow">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<!-- Inclusion of scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
