<html>
    <head>
    <title>LCCT - Library System Report - Users</title>
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
            <p class="pagenumbers">Number of pages: VARIABLE</p>
            <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
            <h1 style="margin-bottom: 10px;">La Consolacion College Tanauan</h1>
            Tanauan City, Batangas 4232 <br>
            Telephone: (043) 778-1020 <br>
            Fax: (043) 778-8850
            <p class="report-title">TestTitle</p>
            <p class="datetoday">{{ date('F d, Y') }}</p>
            <table>
                <thead>
                    <tr>
                        <th>User Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Course / Department</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->user_id}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->role()->first()->name}}</td>
                            <td>{{$user->department()->first()->name}}</td>
                            <td>
                                @if($user->active)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="text-align: right; line-height: 1; margin-top: 40px; margin-bottom: 10px;"><strong>Number of records: {{ count($users) }}</strong></p>
            <p style="text-align: right; padding: 0; margin: 0;"><strong>Printed By: {{ $auth->last_name }}, {{ $auth->first_name }}</strong></p>
        </div>
    </body>
</html>
