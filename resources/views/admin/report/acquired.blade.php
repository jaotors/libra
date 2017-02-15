<html>
    <head>
    <title>LCCT - Library System Report - Books</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                text-align: center;
            }
            .content {
                padding: 10px;
            }
            .logo {
                margin: 0;
            }
            .logo img {
                width: 20%;
            }
            .datetoday,
            .pagenumbers {
                 text-align: right;
                 font-weight: bold;
                 font-size: 14px;
                 margin-bottom: 0;
            }
            .report-title {
                margin: 40px 0 20px;
                font-size: 20px;
                font-weight: bold;
                text-transform: uppercase;
            }
            li {
                list-style-type: none;
            }
            table {
                width: 100%;
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1 style="margin-bottom: 10px;">La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850
            <p class="report-title">{{$title}}</p>
            <p class="datetoday">{{ date('F d, Y') }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Access Number</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Date Acquired</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$book->name}}</td>
                            <td>{{$book->year}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->category()->first()->name}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->created_at->format('Y-m-d')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="text-align: right; line-height: 1;"><strong>Number of records: {{ count($books) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>{{$auth->role()->first()->name}}</strong></p>
        </div>
    </body>
</html>
