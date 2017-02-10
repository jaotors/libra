@extends('opac.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="modal fade modal-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box-container view">
                    <h2 class="title">Book Information</h2>
                    <div class="box-content">
                        <div class="row">
                            <section class="col-md-6">
                                <h4>Book Title</h4>
                                <p class="book-title"></p>
                            </section>
                            <section class="col-md-6">
                                <h4>Author</h4>
                                <p class="author"></p>
                            </section>
                        </div>
                        <section>
                            <h4>Description</h4>
                            <p class="desc"></p>
                        </section>
                        <div class="row">
                            <div class="col-md-6">
                                <section>
                                    <h4>Accession Number</h4>
                                    <p class="num access-num"></p>
                                </section>
                                <section>
                                    <h4>ISBN</h4>
                                    <p class="num isbn"></p>
                                </section>
                                <section>
                                    <h4>Book Publisher</h4>
                                    <p class="book-publisher">Book Publisher</p>
                                </section>
                                <section>
                                    <h4>Book Edition</h4>
                                    <p class="book-edition num">14th</p>
                                </section>
                                <section>
                                    <h4>Location</h4>
                                    <p class="location">Location location</p>
                                </section>
                                <section>
                                    <h4>Book Quantity</h4>
                                    <p class="num book-quantity">14</p>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section>
                                    <h4>Category</h4>
                                    <p class="category"></p>
                                </section>
                                <section>
                                    <h4>Status</h4>
                                    <p class="status"></p>
                                </section>
                                <section>
                                    <h4>Purchase Price</h4>
                                    <p class="num purchase-price">3141.5</p>
                                </section>
                                <section>
                                    <h4>Purchase Date</h4>
                                    <p class="num purchase-date">2016-03-14</p>
                                </section>
                                <section>
                                    <h4>Pages</h4>
                                    <p class="num pages">314</p>
                                </section>
                                <section>
                                    <h4>Call Number</h4>
                                    <p class="num call-number">09314152417</p>
                                </section>
                            </div>
                        </div>
                        <ul class="links">
                            <li><a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a></li>
                            <li><a class="for-avail btn btn-primary" href="">Reserve</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="box-container">
            <ul class="title-tab">
                <li class="active"><a href="#book" role="tab" data-toggle="tab" aria-controls="book" aria-expanded="true">Book List</a></li>
                @if (Auth::check()) 
                    <li><a href="#reservation" role="tab" data-toggle="tab" aria-controls="reservation" aria-expanded="true">Reserved List</a></li>
                    <li><a href="#borrow" role="tab" data-toggle="tab" aria-controls="borrow" aria-expanded="true">Borrow History</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="box-content tab-pane fade active in" id="book" aria-labelledby="book-tab">
                    <div class="searchQuery">
                        {{Form::open(['method' => 'get', 'url' => '/opac/search'])}}
                            <div class="search-input">
                                <div class="form-group search-q">
                                    {{Form::text('search_query', null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group search-select">
                                    {{Form::select('search_select', ['name' => 'Title', 'author' => 'Author', 'isbn' => 'ISBN'], null, ['class' => 'form-control'])}}
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
                                <th>Access Number </th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>ISBN</th>
                                <th>Call Number</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>More Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>
                                        @if($book->id < 0)
                                        @else
                                            {{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}
                                        @endif
                                    </td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->year}}</td>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->call_number}}</td>
                                    <td>{{$book->category()->first()->name}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->status}}</td>
                                    <td><a class="view-book" href="#" data-link="/opac/book/{{$book->id}}/view" data-toggle="modal" data-target=".modal-view"><span class="glyphicon glyphicon-eye-open"></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (isset($searchQuery))
                        {{$books->appends(['search_query' => $searchQuery, 'search_select' => $searchSelect])->links()}}
                    @else
                        {{$books->links()}}
                    @endif
                </div>
                <div class="box-content tab-pane fade" id="reservation" aria-labelledby="reservation-tab">
                    @include('opac/reservation')
                </div>
                <div class="box-content tab-pane fade" id="borrow" aria-labelledby="reservation-tab">
                    @include('opac/borrow')
                </div>
            </div>
        </div>
    </div>
@endsection
