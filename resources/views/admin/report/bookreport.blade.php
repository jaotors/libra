<html>
    <head>
    <title>LCCT - Library System Report - Books</title>
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
    </head>
    <body>
        <div class="content">
            <p class="datetoday">{{ date('F d, Y') }}</p>
            <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1 style="margin-bottom: 10px;">La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850 <br><br>
            <table style="margin-bottom: 5px; width: 100%;">
                <thead>
                    <tr>
                        <th>Access Number</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
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
                            <td>
                                @if($book->deleted_at == null)
                                    {{$book->status}}
                                @else
                                    Unavailable
                                @endif
                            </td>
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
