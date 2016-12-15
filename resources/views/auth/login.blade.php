@extends('auth.layout')

@section('content')
    <div class="login-container">
        @include('errors')
        @include('info')
        
        <div class="logo-container">
            <img src="{!! asset('images/logo.png') !!}" alt="LCCT">
        </div>
        {!! Form::open(['url' => '/login'])!!}
            <div class="form-group">
                {!! Form::label('user_id', 'Student Number / Employee Number', ['class'=> 'control-label']) !!}
                {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password', 'Password', ['class'=> 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            
            <div class="btn-container">
                {!! Form::submit('Login', ['class' => 'btn btn-primary btn-login']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@stop
