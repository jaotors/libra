@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">Add Holiday Information</h2>
            {{Form::open(['url' => '/admin/holidays'])}}
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('name','Holiday Name', ['class' => 'control-label'])}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('date','Date', ['class' => 'control-label'])}}
                            {{Form::date('date', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <p class="btn-container">
                {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
                </p>
            </div>
            {{Form::close()}}
        </div>
        <div class="box-container user-list">
            <h2 class="title">Holiday List</h2>
            <div class="box-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td>{{$holiday->name}}</td>
                                <td>{{$holiday->created_at}}</td>
                                <td>
                                    <a class="edit" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a class="delete" href="/admin/holiday/{{$holiday->id}}/delete"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$holidays->links()}}
            </div>
        </div>
    </div>
@endsection
