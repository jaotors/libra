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
                    <li><a href="/opac">Home</a></li>
                    <li><a href="/opac/reservation">My Reservations</a></li>
                    <li>
                        @if (Auth::check())
                            <a href="/logout"> Logout </a>
                        @else
                            <a href="/login"> Login </a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="main fullwidth opac">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<!-- Inclusion of scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
