@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Setting</h2>
            {{ Form::model($setting, ['url' => '/admin/settings', 'method' => 'put']) }}
            <div class="box-content">
                <div class="col-sm-12">
                    <div class="form-group">
                        {{Form::label('title','Title', ['class' => 'control-label'])}}
                        {{Form::text('title', null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('value','Value', ['class' => 'control-label'])}}
                        {{Form::text('value', null, ['class' => 'form-control'])}}
                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/settings" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
        </div>
        {{ Form::hidden('id', $setting->id) }}
        {{ Form::close() }}
    </div>
@stop
