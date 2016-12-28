@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Book</h2>
            {{ Form::model($book, ['url' => '/admin/books', 'method' => 'put']) }}
            <div class="box-content">
                @include('errors')
                @include('info')
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
                        {{Form::select('category', $categories, $book->category_id, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('status','Status', ['class' => 'control-label'])}}
                        {{Form::select('status', $status, $book->status, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('summary','Summary', ['class' => 'control-label'])}}
                        {{Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '4'])}}
                    </div>
                </div>
            </div>
            <p class="btn-container">{{Form::submit('Update', ['class' => 'btn btn-primary'])}}</p>
        </div>
        {{ Form::hidden('id', $book->id) }}
        {{ Form::close() }}
    </div>
@stop
