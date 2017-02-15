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
            <p class="report-title">Payment Report <br>from: {{$from}} <br>to: {{$to}}<br> <br></p>
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>OR Number</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{str_pad($payment->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$payment->user()->first()->first_name}}</td>
                                <td>{{$payment->user()->first()->last_name}}</td>
                                <td>{{$payment->or_number}}</td>
                                <td>{{number_format($payment->amount, 2)}}</td>
                                <td>{{$payment->payment_date->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <p style="text-align: right; line-height: 1;"><strong>Number of records: {{ count($payments) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>{{$auth->role()->first()->name}}</strong></p>
        </div>
    </body>
</html>
