@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit Announcement</h2>
            {{ Form::model($announcement, ['url' => '/admin/announcements', 'method' => 'put']) }}
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('title','Announcement Title', ['class' => 'control-label']) }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('context', 'Context', ['class' => 'control-label']) }}
                            {{ Form::textarea('context', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/announcements" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
            {{ Form::hidden('id', $announcement->id) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
