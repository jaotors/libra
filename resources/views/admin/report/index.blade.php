@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container reports">
            <h2 class="title">Reports List</h2>
            <div class="box-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Reports</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/user'])}}
                            <td>Users</td>
                            <td>
                                {{Form::select('type', ['All', 'Student', 'Librarian', 'Employee'], null, ['class' => 'form-control'])}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/book'])}}
                            <td>Books</td>
                            <td>
                                {{Form::select('type', ['All', 'Available', 'Unavailable'], null, ['class' => 'form-control'])}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
