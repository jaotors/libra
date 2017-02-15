@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">Clearance Module</h2>
            <div class="box-content borrow">
                <ul class="userList">
                    <li>User Number: <span>{{$user->user_id}}</span></li>
                    <li>Name: <span>{{$user->last_name}}, {{$user->first_name}}</span></li>
                </ul>
                <h3>Borrowed Books</h3> 
                <table class="table">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($books) > 0)
                            @foreach($books as $book)
                                <tr>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->year}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No found results.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <h3>Unpaid Penalties</h3> 
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Penalty </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($histories as $history)
                            @foreach($history->books as $book)
                                @if ($book->pivot->penalty != 0)
                                    <tr>
                                        <td>
                                            {{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}
                                        </td>
                                        <td>{{$book->name}}</td>
                                        <td>{{$book->category()->first()->name}}</td>
                                        <td>{{number_format($book->pivot->penalty, 2)}} </td>
                                        <td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
