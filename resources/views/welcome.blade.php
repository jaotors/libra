<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libra</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="sidenav">
                    <h1 class="logo"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="LCCT"></a></h1>
                    <ul class="nav">
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>Dashboard</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>Books</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Penalty</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Reports</a></li>
                    </ul>
                </div>
                <div class="main">
                    <div class="content">
                        <div class="form-group">
                            <label class="control-label" for="inputDefault">test input</label>
                            <input type="text" class="form-control" id="inputDefault">
                        </div>
                        <div class="form-group has-error">
                            <label class="control-label" for="inputError">test input</label>
                            <input type="text" class="form-control" id="inputError">
                        </div>

                        <a href="#" class="btn btn-default">Default</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
