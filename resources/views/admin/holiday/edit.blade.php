@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit User</h2>
            {{ Form::model($holiday, ['url' => '/admin/holidays']) }}
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('name','Holiday Name', ['class' => 'control-label']) }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('date','Date', ['class' => 'control-label']) }}
                            {{ Form::date('date', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <p class="btn-container">
                {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                </p>
            </div>
            {{ Form::hidden('id', $holiday->id) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
