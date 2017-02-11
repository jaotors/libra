<html>
    <head>
        <style>
            * {
                text-align: center;
            }
            .logo {
                margin: 0;
            }
            .logo img {
                width: 20%;
            }
            .datetoday {
                 text-align: right;
                 font-weight: bold;
                 font-size: 14px;
                 margin: 0 0 30px;
            }
            li {
                list-style-type: none;
            }
            table {
                width: 100%;
            }
        </style>
        <title>Library Receipt</title>
    </head>
    <body>
        <div class="content">
            <p class="datetoday">{{ date('F d, Y') }}</p>
            <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1>La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850 <br>
            <h4 style="text-align: left"> User Number: <span>{{$user->user_id}}</span> <br> Name: <span>{{$user->last_name}}, {{$user->first_name}}</span></h4>
            <h3 class="title add">
                <span>Borrowed Books</span> 
            </h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Borrowed Date</th>
                        <th>Penalty </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0 ; ?>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->name}}</td>
                            <td>{{$book->year}}</td>
                            <td>{{$book->pivot->borrowed_date}}</td>
                            <td>{{$book->pivot->penalty}}</td>
                            <?php $total += $book->pivot->penalty ?>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <br>
            <h4 style="text-align: right"> Total: {{ number_format($total, 2) }} </h4>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
        </div>
    </body>
</html>
