@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Welcome! {{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</h2>
            <div class="box-content">
                <div class="row homepage">
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-piggy-bank big"></span>
                        <h5>Number of unpaid borrows: {{$returns}} </h5>
                        <a href="/admin/return-history"> View Returns </a>
                    </div>
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-book big"></span>
                        <h5>Number of Reserved Books: {{$reservationCount}} </h5>
                    </div>
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-user big"></span>
                        <h5>Valid Users: {{$users}} </h5>
                    </div>
                </div>
                <div class ="row homepage">
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-align-justify big"></span>
                        <h5>On Shelf Books: {{$booksCount}} </h5>
                        <a href="/admin/book"> View Books </a>
                    </div>
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-check big"></span>
                        <h5>Attendance Today: {{$attendanceCount}} </h5>
                        <a href="/admin/attendance"> View Attendance </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
