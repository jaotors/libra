<table class="table table-hover data-table">
    <thead>
        <tr>
            <th>Access Number</th>
            <th>Name</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date Reserved</th>
        </tr>
    </thead>
    <tbody>
        @foreach($histories as $history)
            @foreach($books as $book)
                <tr>
                    <td>
                        {{str_pad($book->id, 5, '0', STR_PAD_LEFT)}}
                    </td>
                    <td>{{$book->name}}</td>
                    <td>{{$book->year}}</td>
                    <td>{{$book->isbn}}</td>
                    <td>{{$book->category()->first()->name}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->created_at->format('Y-m-d h:i:s A')}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
