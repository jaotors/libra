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
                <div class="main opac">
                    <div class="flex-container">
                        <div class="box-container">
                            <h2 class="title">La Consolacion College – Tanauan Library</h2>
                            <div class="box-content">
                                <div class="searchQuery">
                                    <form action="">
                                        <div class="search-input">
                                            <div class="form-group search-q"><input type="text" class="form-control" id="search_query"></div>
                                            <div class="form-group search-select">
                                                <select class="form-control" id="search_select">
                                                    <option value="title">Title</option>
                                                    <option value="author">Author</option>
                                                    <option value="keywords">Keywords</option>
                                                </select>
                                            </div>
                                            <div class="btn-container"><input type="submit" class="btn btn-primary btn-search" value="Search"></div>
                                        </div>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Access Number </th>
                                            <th>Name</th>
                                            <th>Year</th>
                                            <th>ISBN</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>00001</td>
                                            <td>Itaque quae molestiae similique alias iusto fugit</td>
                                            <td>1985</td>
                                            <td>9780772000439</td>
                                            <td>Literature</td>
                                            <td>Abdul Dare</td>
                                            <td>Available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
