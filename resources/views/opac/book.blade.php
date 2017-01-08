@extends('opac.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container view">
            <h2 class="title">Book Information</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="row">
                    <section class="book-title col-md-6">
                        <h4>Book Title</h4>
                        <p>{{ $book->name }}</p>
                    </section>
                    <section class="author col-md-6">
                        <h4>Author</h4>
                        <p>{{ $book->author }}</p>
                    </section>
                </div>
                <section class="desc">
                    <h4>Description</h4>
                    <p>{{ $book->summary }}</p>
                </section>
                <div class="row">
                    <div class="col-md-6">
                        <section class="access-num">
                            <h4>Accession Number</h4>
                            <p class="num">{{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </section>
                        <section class="isbn">
                            <h4>ISBN</h4>
                            <p class="num">{{ $book->isbn }}</p>
                        <section>
                    </div>
                    <div class="col-md-6">
                        <section class="category">
                            <h4>Category</h4>
                            <p>{{$book->category()->first()->name}}</p>
                        </section>
                        <section class="status">
                            <h4>Status</h4>
                            <p>{{ $book->status }}</p>
                        </section>
                    </div>
                </div>
                <div class="links">
                    <a href="/opac" class="btn btn-danger"> Back </a>
                    @if($book->status == 'Available')
                        <a href="/opac/book/{{ $book->id }}/reserve" class="btn btn-primary">Reserve</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
