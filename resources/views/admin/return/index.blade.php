@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">La Consolacion College – Tanauan Library</h2>
            <div class="box-content borrow">
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
                {{ Form::open(['url' => '/admin/return/books', 'method' => 'POST']) }}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Penalty</th>
                            <th>Return Date </th>
                            <th>Set for Return</th>
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
                                        <td>{{number_format(computeForPenalty($book), 2)}}</td>
                                        <td>{{date('Y-m-d', strtotime($book->pivot->return_date))}}</td>
                                        <td>{{ Form::checkbox('books[]', $book->id) }}</td>
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
                <p>
                    {{ Form::submit('Return', ['class' => 'btn btn-success btn-borrow']) }}
                </p>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
