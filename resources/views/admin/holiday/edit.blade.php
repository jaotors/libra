@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Holiday</h2>
            {{ Form::model($holiday, ['url' => '/admin/holidays', 'method' => 'PUT']) }}
                <div class="box-content">
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
                    <p class="btn-container two-buttons">
                        {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                        <a href="/admin/holidays" class="btn btn-danger cancel">Cancel</a>
                    </p>
                </div>
                {{ Form::hidden('id', $holiday->id) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
