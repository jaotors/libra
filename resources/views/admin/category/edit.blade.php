@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Category</h2>
            {{ Form::model($category, ['url' => '/admin/categories', 'method' => 'put']) }}
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{Form::label('name','Category Name', ['class' => 'control-label'])}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/categories" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
        </div>
        {{ Form::hidden('id', $category->id) }}
        {{ Form::close() }}
    </div>
@stop
