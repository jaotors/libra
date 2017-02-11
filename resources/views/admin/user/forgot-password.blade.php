@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Forgot Password</h2>
            {{ Form::open(['url' => '/admin/user/forgot-password', 'method' => 'put']) }}
            <div class="box-content">
                <div class="form-group">
                    {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                    {{ Form::password('password', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label']) }}
                    {{ Form::password('password_confirmation', null, ['class' => 'form-control']) }}
                </div>

                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/books" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
        </div>
        {{ Form::hidden('id', $user->id) }}
        {{ Form::close() }}
    </div>
@stop
