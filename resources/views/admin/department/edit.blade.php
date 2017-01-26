@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Department</h2>
            {{ Form::model($department, ['url' => '/admin/departments', 'method' => 'put']) }}
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{Form::label('name','Department Name', ['class' => 'control-label'])}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/departments" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
        </div>
        {{ Form::hidden('id', $department->id) }}
        {{ Form::close() }}
    </div>
@stop
