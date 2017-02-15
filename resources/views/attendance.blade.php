@extends('auth.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="login-container" style="text-align:center">
        <div class="logo-container">
            <img src="{!! secure_asset('images/logo.png') !!}" alt="LCCT">
        </div>
        <h2> Attendance Module </h2>
        <div id="reader" style="width:300px;height:250px; margin:auto; display:block;"></div>
        {{Form::open(['url' => 'attendance'])}}
            {{Form::label('user_id', 'User ID', ['form-control'])}}
            {{Form::text('user_id', null, ['class' => 'form-control', 'id' => 'user_id'])}}
            <br>
            {{Form::submit('Log', ['class' => 'btn btn-success', 'id' => 'submit-btn'])}}
        {{Form::close()}}
    </div>
    @stop
    @section('scripts')
        <script>
                $('#reader').html5_qrcode(function(data){
                    var student_number = data.split("\n")[1];
                    $('#user_id').val(student_number);
                    $('#submit-btn').click();
                }, function(error){
                    console.log(error);
                }, function(videoError){
                    console.log('Cannot be oppened')
                });

        </script>
    @endsection
