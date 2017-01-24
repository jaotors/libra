@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title fixed">La Consolacion College – Tanauan Library</h2>
            <div class="box-content borrow">
                @include('errors')
                @include('info')
                <div class="searchQuery">
                    {{Form::open(['method' => 'get', 'url' => 'admin/return/search'])}}
                    <div class="search-input">
                        <div class="form-group search-q">
                            {{Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => 'User Number'])}}
                        </div>
                        <div class="btn-container">
                            {{Form::submit('Search', ['class' => 'btn btn-primary btn-search'])}} </div>
                    </div>
                    {{Form::close()}}
                </div>
                @if(!is_null($user))
                    <ul class="userList">
                        <li>User Number: <span>{{$user->user_id}}</span></li>
                        <li>Name: <span>{{$user->last_name}}, {{$user->first_name}}</span></li>
                    </ul>
                @endif
                <h3 class="title add">
                    <span>Borrowed Books</span> 
                </h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Return Date </th>
                            <th>Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($books) > 0)
                            @foreach($books as $book)
                                @if(!isSetForReturn($book->id))
                                    <tr>
                                        <td>{{$book->isbn}}</td>
                                        <td>{{$book->name}}</td>
                                        <td>{{$book->year}}</td>
                                        <td>{{date('Y-m-d', strtotime($book->pivot->return_date))}}</td>
                                        <td><a class="btn btn-primary btn-xs" href="/admin/return/set/{{$book->id}}"><span class="glyphicon glyphicon-resize-small" aria-hidden="true"></span></a></td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No found results.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br> <br>
                <h3 class="title add">
                    <span>Books to be Returned</span> 
                </h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Return Date</th>
                            <th>Penalty</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::has('books')))
                            @foreach(Session::get('books') as $book)
                                <tr>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->borrower()->first()->pivot->return_date}}</td>
                                    <td>{{number_format(computeForPenalty($book), 2)}}</td>
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
                @if(count(Session::get('books')) > 0)
                    <p>
                        <a href="/admin/return/books" class="btn btn-success btn-borrow"><i class="glyphicon glyphicon-resize-small"></i> Return</a>
                        <a href="/admin/return/print/{{$user->id}}" class="btn btn-primary btn-borrow"><i class="glyphicon glyphicon-print"></i> Print</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
