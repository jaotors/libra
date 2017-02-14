<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Libra</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Inclusion of additional styles -->
    @yield('styles')
</head>
<body class="login">
    <img class="background-img" src="{{ asset('/images/bg-login.jpg') }}" alt="">
    <div class="container-fluid">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>
