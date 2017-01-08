@extends('admin.layout')

@section('content')
    <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container add-user">
                    <h2 class="title">Add Book Information</h2>
                    {{Form::open(['url' => '/admin/books'])}}
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{Form::label('name','Book Name', ['class' => 'control-label'])}}
                                    {{Form::text('name', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('year','Year', ['class' => 'control-label'])}}
                                    {{Form::text('year', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('author','Author', ['class' => 'control-label'])}}
                                    {{Form::text('author', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('isbn','ISBN', ['class' => 'control-label'])}}
                                    {{Form::text('isbn', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('category','Category', ['class' => 'control-label'])}}
                                    {{Form::select('category', $categories, null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('summary','Summary', ['class' => 'control-label'])}}
                                    {{Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '4'])}}
                                </div>
                            </div>
                        </div>
                        <p class="btn-container">
                            {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
                        </p>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title">Weed List</h2>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->year}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->category()->first()->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->status}}</td>
                                <td>
                                    <a class="edit" href="/admin/weed/{{$book->id}}"><span class="glyphicon glyphicon-repeat"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
