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
                <div class="content">
                    <p>La Consolacion College – Tanauan</p>
                    <ul class="nav">
                        <li><a href="/opac">Home</a></li>
                        <li class="drop">
                            <a href="#">Account</a>
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target=".modal-change-pass">Change Password</a></li>
                                <li><a href="#">Help</a></li>
                                <li>
                                    @if (Auth::check())
                                        <a href="/logout"> Logout </a>
                                    @else
                                        <a href="/login"> Login </a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main fullwidth opac">
                @include('opac.changepassword')
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="fullwidth">
        <ul class="contact-list">
            <li>Tanauan City, Batangas 4232</li>
            <li>Telephone: (043) 778-1020</li>
            <li>Fax: (043) 778-8850</li>
            <li>E-mail: <a href="mailto:OLFA_Community@yahoo.com">OLFA_Community@yahoo.com</a></li>
        </ul>
    </footer>
</body>
<!-- Inclusion of scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
</html>
