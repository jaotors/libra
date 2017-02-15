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
            <h1 class="attendanceo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1 style="margin-bottom: 10px;">La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850 <br>
            <p class="report-title">Attendance Report <br>from: {{$from}} <br>to: {{$to}}<br> <br></p>
            <table class="attendances-table table data-table table-hover">
                    <thead>
                        <tr>
                            <th>User Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Type</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{$attendance->user()->first()->user_id}}</td>
                                <td>{{$attendance->user()->first()->first_name}}</td>
                                <td>{{$attendance->user()->first()->last_name}}</td>
                                <td>{{$attendance->user()->first()->role()->first()->name}}</td>
                                <td>{{$attendance->created_at->format('Y-m-d h:i:s A')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <p style="text-align: right; line-height: 1;"><strong>Number of records: {{ count($attendances) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>{{$auth->role()->first()->name}}</strong></p>
        </div>
    </body>
</html>
