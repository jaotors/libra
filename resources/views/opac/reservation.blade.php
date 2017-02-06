<table class="table table-hover">
    <thead>
        <tr>
            <th>Access Number</th>
            <th>Name</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date Reserved</th>
            <th>Date Expiration</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>
                    {{str_pad($reservation->id, 5, '0', STR_PAD_LEFT)}}
                </td>
                <td>{{$reservation->name}}</td>
                <td>{{$reservation->year}}</td>
                <td>{{$reservation->isbn}}</td>
                <td>{{$reservation->category()->first()->name}}</td>
                <td>{{$reservation->author}}</td>
                <td>{{$reservation->created_at->format('Y-m-d h:i:s A')}}</td>
                <td>Test</td>
                <td><a class="delete" href="/opac/book/{{$reservation->id}}/remove"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
