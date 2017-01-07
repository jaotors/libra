@extends('borrow.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title add">La Consolacion College – Tanauan Library <a href="#" data-toggle="modal" data-target=".modal-add"><span class="glyphicon glyphicon-plus"></span></a></h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="searchQuery">
                    {{Form::open(['method' => 'get', 'url' => 'borrow/search'])}}
                        <div class="search-input">
                            <div class="form-group search-q">
                                {{Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => 'User Number'])}}
                            </div>
                            <div class="btn-container">
                                {{Form::submit('Search', ['class' => 'btn btn-primary btn-search'])}}
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User Number</th>
                            <th>Book Name</th>
                            <th>Category</th>
                            <th>Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{$reservation->user()->first()->user_id}}</td>
                                <td>{{$reservation->book()->first()->name}}</td>
                                <td>{{$reservation->book()->first()->category()->first()->name}}</td>
                                <td>{{$reservation->return_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (isset($searchQuery))
                    {{$reservations->appends(['search_query' => $searchQuery])->links()}}
                @else
                    {{$reservations->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
