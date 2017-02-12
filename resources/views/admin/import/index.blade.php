@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container reports">
            <h2 class="title">Import Data</h2>
            <div class="box-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Import</th>
                            <th>&nbsp;</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{Form::open(['url' => '/admin/import', 'target' => '_blank', 'files' => true])}}
                            <td>{{Form::select('type', ['Users', 'Books'], null, ['class' => 'form-control'])}}</td>
                            <td>{{Form::file('file', null, ['class' => 'form-control'])}}</td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-upload"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
