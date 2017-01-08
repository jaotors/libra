@extends('opac.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">Your Reservations</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number </th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>
                                    {{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}
                                </td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->year}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->category()->first()->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->status}}</td>
                                <td><a class="delete" href="/opac/book/{{$book->id}}/remove"><span class="glyphicon glyphicon-ban-circle"></span></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/opac" class="btn btn-danger"> Back </a>
            </div>
        </div>
    </div>
@endsection
