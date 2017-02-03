@extends('admin.layout')

@section('content')
    <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container add-user">
                    <h2 class="title">Add User Information</h2>
                    {{Form::open(['url' => '/admin/users'])}}
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{Form::label('user_id','Student ID / Employee ID', ['class' => 'control-label'])}}
                                    {{Form::text('user_id', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('first_name', 'First Name', ['class' => 'control-label'])}}
                                    {{Form::text('first_name', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('last_name', 'Last Name', ['class' => 'control-label'])}}
                                    {{Form::text('last_name', null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{Form::label('role', 'Role', ['class' => 'control-label'])}}
                                    {{Form::select('role', $roles, null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('email', 'Email', ['class' => 'control-label'])}}
                                    {{Form::text('email', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('department', 'Course / Department', ['class' => 'control-label'])}}
                                    {{Form::select('department', $departments, null, ['class' => 'form-control', 'id' => 'department'])}}
                                </div>
                            </div>
                        </div>
                        <p class="btn-container two-buttons">
                            {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
                            <a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a>
                        </p>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">User List <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a></h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Course / Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->user_id}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->role()->first()->name}}</td>
                            <td>{{$user->department()->first()->name}}</td>
                            <td>
                                @if($user->active)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a class="edit" href="/admin/user/{{$user->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
