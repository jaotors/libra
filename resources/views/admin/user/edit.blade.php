@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Edit User</h2>
            {{ Form::model($user, ['url' => '/admin/users', 'method' => 'put']) }}
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('user_id','Student ID / Employee ID', ['class' => 'control-label']) }}
                            {{ Form::text('user_id', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('first_name', 'First Name', ['class' => 'control-label']) }}
                            {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('last_name', 'Last Name', ['class' => 'control-label']) }}
                            {{ Form::text('last_name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('active', 'Active', ['class' => 'control-label']) }}
                            {{ Form::select('active',['1' => 'Yes', '0' => 'No'] ,null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('email', 'Email', ['class' => 'control-label'])}}
                            {{Form::text('email', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('role', 'Role', ['class' => 'control-label']) }}
                            {{ Form::select('role', $roles, $user->role_id, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('department', 'Course / Department', ['class' => 'control-label']) }}
                            {{ Form::select('department', $departments, $user->department_id, ['class' => 'form-control', 'id' => 'department']) }}
                        </div>

                    </div>
                </div>
                <p class="btn-container two-buttons">
                    {{Form::submit('Update', ['class' => 'btn btn-primary update'])}}
                    <a href="/admin/users" class="btn btn-danger cancel">Cancel</a>
                </p>
            </div>
            {{ Form::hidden('id', $user->id) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
