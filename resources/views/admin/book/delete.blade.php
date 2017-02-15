@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container add-user">
            <h2 class="title">Delete this Book</h2>
            {{Form::open(['url' => '/admin/book/remove'])}}
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{Form::label('remarks','Remarks', ['class' => 'control-label'])}}
                            {{Form::select('remarks', $remarks, null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Delete', ['class' => 'btn btn-warning'])}}
                    <a href="/admin/books" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
        {{ Form::hidden('id', $book->id) }}
        {{ Form::close() }}
        </div>
    </div>
@stop
