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
<body>
<div class="container-fluid">
    <div class="sidenav">
        <h1 class="logo"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="LCCT"></a></h1>
        <p class="school-name">La Consolacion College Tanauan</p>
        <p class="address">Tanauan City, Batangas 4232</p>
        <ul class="contact-list">
            <li>Telephone: (043) 778-1020</li>
            <li>Fax: (043) 778-8850</li>
            <li>E-mail: <a href="mailto:OLFA_Community@yahoo.com">OLFA_Community@yahoo.com</a></li>
        </ul>
        <ul class="nav">
            <li class="dropdown {{ $active_state == 'users'? 'down' : '' }} {{ $active_state == 'departments'? 'down' : '' }}">
                <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>User Management</a>
                <ul>
                    <li class="{{ $active_state == 'users'? 'active' : '' }}"><a href="/admin/users"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Users</a></li>
                    <li class="{{ $active_state == 'departments'? 'active' : '' }}"><a href="/admin/departments"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Academic Programs</a></li>
                </ul>
            </li>
            <li class="dropdown {{ $active_state == 'categories'? 'down' : '' }} {{ $active_state == 'books'? 'down' : '' }} {{ $active_state == 'weeds'? 'down' : ''}}">
                <a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>Book Classification</a>
                <ul>
                    <li class="{{ $active_state == 'books' ? 'active' : '' }}"><a href="/admin/books"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Books</a></li>
                    <li class="{{ $active_state == 'categories' ? 'active' : '' }}"><a href="/admin/categories"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Book Classification</a></li>
                    <li class="{{ $active_state == 'weeds' ? 'active' : '' }}"><a href="/admin/weeds"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Weeding</a></li>
                </ul>
            </li>
            <li class="dropdown {{ $active_state == 'borrow'? 'down' : '' }} {{ $active_state == 'return'? 'down' : '' }} {{ $active_state == 'return-history'? 'down' : '' }}">
                <a href="#"><span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span>Basic Transaction</a>
                <ul>
                    <li class="{{ $active_state == 'borrow' ? 'active' : '' }}"><a href="/admin/borrow"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Borrow</a></li>
                    <li class="{{ $active_state == 'return' ? 'active' : '' }}"><a href="/admin/return"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Return</a></li>
                    <li class="{{ $active_state == 'return-history' ? 'active' : '' }}"><a href="/admin/return-history"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>Return History</a></li>
                </ul>
            </li>
            <li><a href="/admin/holidays"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Holidays</a></li>
            <li><a href="/admin/reports"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Reports</a></li>
            <li><a href="/admin/logs"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span>Logs</a></li>
            <li><a href="/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Logout</a></li>
        </ul>
    </div>
    <div class="main">
        @yield('content')
    </div>
</div>

<!-- Inclusion of scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('scripts')
</body>
</html>
