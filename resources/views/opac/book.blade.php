@extends('opac.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">Book Information</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <h3> Book Title </h3>
                {{ $book->name }}
                <h3> Description </h3>
                {{ $book->summary }}
                <h3> Author </h3>
                {{ $book->author }}
                <h3> ISBN </h3>
                {{ $book->isbn }}
                <h3> Accession Number </h3>
                {{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}
                <h3> Status </h3>
                {{ $book->status }}
                <h3> Category </h3>
                {{$book->category()->first()->name}}
                <br>
                <br>
                <a href="/opac" class="btn btn-danger"> Back </a>
                @if($book->status == 'Available')
                    <a href="/opac/book/{{ $book->id }}/reserve" class="btn btn-primary">Reserve</a>
                @endif
            </div>
        </div>
    </div>
@endsection
