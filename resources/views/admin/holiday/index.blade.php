@extends('admin.layout')

@section('content')
    <div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container">
                    <h2 class="title">Add Holiday Information</h2>
                    {{ Form::open(['url' => '/admin/holidays']) }}
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
                                <div class="form-group">
                                    {{ Form::label('type','Type', ['class' => 'control-label']) }}
                                    {{ Form::select('type', $types, null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <p class="btn-container">
                        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                        </p>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Holiday List <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a></h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td>{{ $holiday->name }}</td>
                                <td>{{ $holiday->date }}</td>
                                <td>{{ $holiday->type }}</td>
                                <td>
                                    <a class="edit" href="/admin/holiday/{{ $holiday->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a class="delete" href="/admin/holiday/{{ $holiday->id }}/delete"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
