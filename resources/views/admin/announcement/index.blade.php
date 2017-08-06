@extends('admin.layout')

@section('content')
    <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container add-user">
                    <h2 class="title">Add Announcement</h2>
                    {{Form::open(['url' => '/admin/announcements'])}}
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{Form::label('title','Announcement Title', ['class' => 'control-label'])}}
                                    {{Form::text('title', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('context', 'Context', ['class' => 'control-label'])}}
                                    {{Form::textarea('context', null, ['class' => 'form-control'])}}
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
        <div class="box-container announcements">
            <h2 class="title add">Announcement List <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a></h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number </th>
                            <th>Announcement Title</th>
                            <th>Context</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <td>{{ str_pad($announcement->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ $announcement->context }}</td>
                                <td>
                                    <a class="edit" href="/admin/announcement/{{ $announcement->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a class="delete" href="/admin/announcement/{{ $announcement->id }}/delete"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
