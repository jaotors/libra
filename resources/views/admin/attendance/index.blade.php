@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Attendance List</h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Log Time</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{date_format($attendance->created_at, 'Y/m/d h:i:s a')}}</td>
                                <td>{{$attendance->user()->first()->first_name}}</td>
                                <td>{{$attendance->user()->first()->last_name}}</td>
                                <td>{{$attendance->user()->first()->department()->first()->name}}</td>
                                <td>{{$attendance->user()->first()->role()->first()->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
