@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Borrowed Books by: {{$user->first_name . " " . $user->last_name}}</h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Name</th>
                        <th>Publisher</th>
                        <th>Category</th>
                        <th>Date Borrowed</th>
                        <th>Return Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->name}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->category()->first()->name}}</td>
                            <td>{{date('Y-m-d', strtotime($book->pivot->created_at))}}</td>
                            <td>{{date('Y-m-d', strtotime($book->pivot->return_date))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="/admin/users" class="btn btn-primary"> Back </a>
                <a href="/admin/borrow/{{$user->id}}/print" class="btn btn-success" target="_blank"><span class="glyphicon glyphicon-print"></span> Print </a>
            </div>
        </div>
    </div>
@stop
