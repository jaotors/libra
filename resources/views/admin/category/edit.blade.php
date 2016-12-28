@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Category</h2>
            {{ Form::model($category, ['url' => '/admin/categories', 'method' => 'put']) }}
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{Form::label('name','Category Name', ['class' => 'control-label'])}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
            </div>
            <p class="btn-container">{{Form::submit('Update', ['class' => 'btn btn-primary'])}}</p>
        </div>
        {{ Form::hidden('id', $category->id) }}
        {{ Form::close() }}
    </div>
@stop
