@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container books">
            <h2 class="title add">Return History Information</h2>
            <div class="box-content">
                <h4>Return Date: {{ $return->created_at->format('Y-m-d') }}
                <h4>User: {{ $return->user()->first()->last_name . ', ' . $return->user()->first()->first_name }}</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number </th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->year}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->category()->first()->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->status}}</td>
                                <td>{{number_format($book->pivot->penalty, 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <a href="/return-history/print/{{$return->id}}" target="_blank" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Print </a>
            </div>
        </div>
    </div>
@endsection
