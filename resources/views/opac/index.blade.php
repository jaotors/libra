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
                                    <h4>Material</h4>
                                    <p class="material"></p>
                                </section>
                                <section>
                                    <h4>Location</h4>
                                    <p class="location">Location location</p>
                                </section>
                            </div>
                        </div>
                        <ul class="links">
                            <li><a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a></li>
                            @if(Auth::check())
                                <li><a class="for-avail btn btn-primary" href="">Reserve</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="box-container">
            <ul class="title-tab">
                <li class="active"><a href="#book" role="tab" data-toggle="tab" aria-controls="book" aria-expanded="true">OPAC</a></li>
                @if (Auth::check()) 
                    <li><a href="#reservation" role="tab" data-toggle="tab" aria-controls="reservation" aria-expanded="true">Reserved List</a></li>
                    <li><a href="#borrow" role="tab" data-toggle="tab" aria-controls="borrow" aria-expanded="true"> Current Books </a> </li>
                    <li><a href="#borrowed" role="tab" data-toggle="tab" aria-controls="borrowed" aria-expanded="true">Borrow History</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="box-content tab-pane fade active in" id="book" aria-labelledby="book-tab">
                    <div class="searchQuery">
                        {{Form::open(['method' => 'get', 'url' => '/opac/search'])}}
                            <div class="search-input">
                                <div class="form-group search-select">
                                    {{Form::label('material','Material', ['class' => 'control-label'])}}
                                    {{Form::select('material', ['-1' => 'Choose One','Textbook' => 'Textbook', 'Manuscripts' => 'Manuscripts', 'Periodicals' => 'Periodicals', 'Others' => 'Others'], null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group search-select">
                                    {{Form::label('category','Category', ['class' => 'control-label'])}}
                                    {{Form::select('category', $categories, null, ['class' => 'form-control'])}}
                                </div>
                                <div class="form-group search-select">
                                    {{Form::label('status','Status', ['class' => 'control-label'])}}
                                    {{Form::select('status', ['-1' => 'Choose One', 'Available' => 'Available', 'Reserved' => 'Reserved', 'Borrowed' => 'Borrowed'], null, ['class' => 'form-control'])}}
                                </div>
                            </div>
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
                                <th>Book Title</th>
                                <th>Copyright</th>
                                <th>ISBN</th>
                                <th>Call Number</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Location </th>
                                <th>Material Type</th>
                                <th>No. of Copies</th>
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
                                    <td>{{$book->publisher}}</td>
                                    <td>{{$book->location}}</td>
                                    <td>{{$book->material}}</td>
                                    <td>{{noOfCopies($book)}}</td>
                                    <td>
                                        @if ($book->status == 'Available')
                                            <span class=" glyphicon glyphicon-ok-sign"> </span>
                                        @else
                                            <span class="glyphicon glyphicon-remove-sign"> </span>

                                        @endif
                                    </td>
                                    <td><a class="view-book" href="#" data-link="/opac/book/{{$book->id}}/view" data-toggle="modal" data-target=".modal-view"><span class="glyphicon glyphicon-eye-open"></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (isset($searchQuery))
                        {{$books->appends(['search_query' => $searchQuery, 'search_select' => $searchSelect])->links()}}
                    @else
                        @if(count($books) > 0)
                            {{$books->links()}}
                        @endif
                    @endif
                </div>
                <div class="box-content tab-pane fade" id="reservation" aria-labelledby="reservation-tab">
                    @include('opac/reservation')
                </div>
                <div class="box-content tab-pane fade" id="borrowed" aria-labelledby="reservation-tab">
                    @include('opac/borrowed')
                </div>
                <div class="box-content tab-pane fade" id="borrow" aria-labelledby="reservation-tab">
                    @include('opac/borrow')
                </div>
            </div>
        </div>
    </div>
@endsection
