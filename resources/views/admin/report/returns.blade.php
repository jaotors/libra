<html>
    <head>
    <title>LCCT - Library System Report - Books</title>
        <style>
            * {
                text-align: center;
            }
            .attendanceo {
                margin: 0;
            }
            .attendanceo img {
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
            .report-title {
                margin: 40px 0 20px;
                font-size: 20px;
                font-weight: bold;
                text-transform: uppercase;
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
            <p class="report-title">Returns Report <br>from: {{$from}} <br>to: {{$to}}<br> <br></p>

                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Return ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Returned Date</th>
                            <th>Penalties</th>
                            <th>Is Paid?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)
                            <tr>
                                <td>{{str_pad($return->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$return->user()->first()->first_name}}</td>
                                <td>{{$return->user()->first()->last_name}}</td>
                                <td>{{$return->created_at->format('Y-m-d')}}</td>
                                <td>{{number_format($return->books()->sum('penalty'), 2)}}</td>
                                <td>
                                    @if($return->is_paid)
                                        Yes
                                    @else
                                        No 
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <p style="text-align: right; line-height: 1;"><strong>Number of records: {{ count($returns) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>{{$auth->role()->first()->name}}</strong></p>
        </div>
    </body>
</html>
