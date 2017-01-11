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
        <ul class="nav">
            <li><a href="/admin/users"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Users</a></li>
            <li><a href="/admin/departments"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>Courses</a></li>
            <li><a href="/admin/categories"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>Categories</a></li>
            <li><a href="/admin/books"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>Books</a></li>
            <li><a href="/admin/borrow"><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>Borrow</a></li>
            <li><a href="/admin/holidays"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Holidays</a></li>
            <li><a href="/admin/penalties"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Penalty</a></li>
            <li><a href="/admin/reports"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Reports</a></li>
            <li><a href="/admin/weeds"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Weeding</a></li>
            <li><a href="/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Logout</a></li>
        </ul>
    </div>
    <div class="main">
        @yield('content')
    </div>
</div>
<!-- Inclusion of scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('scripts')
</body>
</html>
