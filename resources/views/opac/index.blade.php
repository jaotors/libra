@extends('opac.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">La Consolacion College – Tanauan Library</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="searchQuery">
                    {{Form::open(['method' => 'get', 'url' => 'opac/search'])}}
                        <div class="search-input">
                            <div class="form-group search-q">
                                {{Form::text('search_query', null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group search-select">
                                {{Form::select('search_select', ['name' => 'Title', 'author' => 'Author', 'keywords' => 'Keywords'], null, ['class' => 'form-control'])}}
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
                            <th>Access Number </th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>
                                    @if($book->id < 0)
                                    @else
                                        {{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}
                                    @endif
                                </td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->year}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->category()->first()->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$books->links()}}
            </div>
        </div>
    </div>
@endsection
