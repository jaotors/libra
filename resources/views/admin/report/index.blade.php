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
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/user', 'target' => '_blank', 'method' => 'GET'])}}
                            <td>Users</td>
                            <td>&nbsp;</td>
                            <td>
                                {{Form::select('type', ['All', 'Student', 'Librarian', 'Employee', 'Active', 'Inactive'], null, ['class' => 'form-control'])}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/book', 'target' => '_blank', 'method' => 'GET'])}}
                            <td>Books</td>
                            <td>&nbsp;</td>
                            <td>
                                {{Form::select('type', ['All', 'Available', 'Unavailable', 'Unreturned','Damaged','Lost Book', 'Lost Material'], null, ['class' => 'form-control'])}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            <td> Generate Book Barcode </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><a href="/admin/reports/barcode" class="print-btn" target="_blank"><span class="glyphicon glyphicon-print"></span></a></td>
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/returns', 'target' => '_blank', 'method' => 'GET'])}}
                            <td> Returns </td>
                            <td>
                                {{Form::label('from','From')}}
                                {{Form::date('from')}}
                            </td>
                            <td>
                                {{Form::label('to','To')}}
                                {{Form::date('to')}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/payments', 'target' => '_blank', 'method' => 'GET'])}}
                            <td> Payments </td>
                            <td>
                                {{Form::label('from','From')}}
                                {{Form::date('from')}}
                            </td>
                            <td>
                                {{Form::label('to','To')}}
                                {{Form::date('to')}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/logs', 'target' => '_blank', 'method' => 'GET'])}}
                            <td> Transaction History </td>
                            <td>
                                {{Form::label('from','From')}}
                                {{Form::date('from')}}
                            </td>
                            <td>
                                {{Form::label('to','To')}}
                                {{Form::date('to')}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/attendance', 'target' => '_blank', 'method' => 'GET'])}}
                            <td> Attendance </td>
                            <td>
                                {{Form::label('from','From')}}
                                {{Form::date('from')}}
                            </td>
                            <td>
                                {{Form::label('to','To')}}
                                {{Form::date('to')}}
                            </td>
                            <td>
                                <button class="print-btn"><span class="glyphicon glyphicon-print"></span></button>
                            </td>
                            {{Form::close()}}
                        </tr>
                        <tr>
                            {{Form::open(['url' => 'admin/reports/borrow', 'target' => '_blank', 'method' => 'GET'])}}
                            <td> Borrows </td>
                            <td>
                                {{Form::label('from','From')}}
                                {{Form::date('from')}}
                            </td>
                            <td>
                                {{Form::label('to','To')}}
                                {{Form::date('to')}}
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
