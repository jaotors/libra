@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">User Logs</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <table class="logs-table table data-table table-hover">
                    <thead>
                        <tr>
                            <th>User Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Type</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{$log->user()->first()->user_id}}</td>
                                <td>{{$log->user()->first()->first_name}}</td>
                                <td>{{$log->user()->first()->last_name}}</td>
                                <td>{{$log->user()->first()->role()->first()->name}}</td>
                                <td>{{strtoupper($log->action)}}</td>
                                <td>{{$log->created_at->format('Y-m-d h:i:s A')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
