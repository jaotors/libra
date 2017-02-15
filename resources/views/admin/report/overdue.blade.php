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
            <p class="datetoday">{{ date('F d, Y') }}</p>
            <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1 style="margin-bottom: 10px;">La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850 <br>
            <p class="report-title">Book Overdue Report<br></p>
            <table>
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Penalty</th>
                            <th>Return Date </th>
                            <th>Borrowed Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrows as $borrow)
                            <tr>
                                <td>{{$borrow->book->isbn}}</td>
                                <td>{{$borrow->book->name}}</td>
                                <td>{{$borrow->user->first_name . ' ' . $borrow->user->last_name}}</td>
                                <td>{{number_format(computeForPenalty($borrow->book), 2)}}</td>
                                <td>{{date('Y-m-d', strtotime($borrow->return_date))}}</td>
                                <td>{{date('Y-m-d', strtotime($borrow->created_at))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <p style="text-align: right; line-height: 1;"><strong>Number of records: {{ count($borrows) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>{{$auth->role()->first()->name}}</strong></p>
        </div>
    </body>
</html>
