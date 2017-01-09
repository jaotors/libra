@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">La Consolacion College – Tanauan Library</h2>
            <div class="box-content borrow">
                @include('errors')
                @include('info')
                <div class="searchQuery">
                    {{Form::open(['method' => 'get', 'url' => 'borrow/search'])}}
                        <div class="search-input">
                            <div class="form-group search-q">
                                {{Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => 'User Number'])}}
                            </div>
                            <div class="btn-container">
                                {{Form::submit('Search', ['class' => 'btn btn-primary btn-search'])}}
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number</th>
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
                                <td>
                                    <a class="delete" href="/admin/borrow/{{$book->id}}/borrow"><span class="glyphicon glyphicon-ban-circle"></span></a>
                                    <a class="delete" href="/admin/borrow/{{$book->id}}/remove"><span class="glyphicon glyphicon-ban-circle"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
