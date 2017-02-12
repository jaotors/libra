@extends('admin.layout')

@section('content')
    <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container add-user">
                    <h2 class="title">Add Department Information</h2>
                    {{ Form::open(['url' => '/admin/departments']) }}
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('name','Department Name', ['class' => 'control-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <p class="btn-container two-buttons">
                            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                            <a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a>
                        </p>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Department List <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a></h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->created_at }}</td>
                                <td>
                                    <a class="edit" href="/admin/department/{{ $department->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$departments->links()}}
            </div>
        </div>
    </div>
@endsection
