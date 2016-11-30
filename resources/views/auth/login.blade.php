@extends('auth.layout')

@section('content')
    <h1>Login</h1>
    {!! Form::open(['url' => '/login'])!!}

        {!! Form::label('user_id', 'Student Number / Employee Number') !!}
        {!! Form::text('user_id') !!}

        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password') !!}

        {!! Form::submit('Login') !!}

    {!! Form::close() !!}

    @include('errors')
    @include('info')
@stop
