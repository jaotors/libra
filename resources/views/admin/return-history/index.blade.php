@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title">Return List</h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Return ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Returned Date</th>
                            <th>Penalties</th>
                            <th>Is Paid?</th>
                            <th>View Books</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)
                            <tr>
                                <td>{{str_pad($return->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$return->user()->first()->first_name}}</td>
                                <td>{{$return->user()->first()->last_name}}</td>
                                <td>{{$return->created_at->format('Y-m-d')}}</td>
                                <td>{{number_format($return->books()->sum('penalty'), 2)}}</td>
                                <td>
                                    @if($return->is_paid)
                                        Yes
                                    @else
                                        No 
                                    @endif
                                </td>
                                <td>
                                    <a class="edit" href="/admin/return-history/{{$return->id}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
