@extends('admin.layout')

@section('content')
    @if(!is_null($user))
        <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content borrow">
                    <div class="box-container add-user">
                        <h2 class="title">Borrow Book</h2>
                        {{Form::open(['url' => 'admin/borrow/reserve'])}}
                        <div class="box-content">
                            <div class="form-group">
                                {{Form::label('isbn','ISBN', ['class' => 'control-label'])}}
                                {{Form::text('isbn', null, ['class' => 'form-control'])}}
                                {{Form::hidden('user_id', "$user->id")}}
                            </div>
                            <p class="btn-container two-buttons">
                                {{Form::submit('Borrow', ['class' => 'btn btn-primary'])}}
                                <a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a>
                            </p>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">La Consolacion College – Tanauan Library</h2>
            <div class="box-content borrow">
                <div class="searchQuery">
                    {{Form::open(['method' => 'get', 'url' => 'admin/borrow/search'])}}
                        <div class="search-input">
                            <div class="form-group search-q">
                                @if(is_null($user))
                                    <div id="reader" style="width:300px;height:250px; margin:auto; display:block;"></div>
                                @endif
                                {{Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => 'User ID', 'id' => "user_id"])}}
                            </div>
                            <div class="btn-container">
                                {{Form::submit('Search', ['class' => 'btn btn-primary btn-search', 'id' => 'submit-btn'])}}
                            </div>
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
                    <span>Reserved Books</span> 
                    @if(!is_null($user))
                        <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a>
                    @endif
                </h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($books) > 0)
                            @foreach($books as $book)
                                <tr>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->year}}</td>
                                    <td>
                                        {{Form::open(['url' => '/admin/borrow/remove/book'])}}
                                            {{Form::hidden('id', $book->id)}}
                                            {{Form::hidden('user_id', $user->id)}}
                                            {{Form::submit('x')}}
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No found results.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if (count($histories))
                    <h3 class="title add">
                        <span>Unpaid Penalties</span> 
                    </h3>
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
                @endif
                @if (count($books) > 0)
                    <p><a href="/admin/borrow/{{ $user->id }}/borrow" class="btn btn-success btn-borrow">Borrow</a></p>
                @endif
                <p><a href="/admin/return/" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-download"></span> Return Module</a></p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(is_null($user))
        <script>
            $('#reader').html5_qrcode(function(data){
                var student_number = data.split("\n")[1];
                $('#user_id').val(student_number);
                $('#submit-btn').click();
            }, function(error){
                console.log(error);
            }, function(videoError){
                console.log('Cannot be oppened')
            });
        </script>
    @endif
@endsection
