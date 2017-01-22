<html>
    <head>
        <style> 
            * {
                text-align: center;
            }
            li {
                list-style-type: none;
            }
            table {
                width: 100%;            
            }
            img {
                width: 10%;
            }
        </style>
    </head>
    <body>
        <h1 class="logo"><a href="/"><img src="./images/logo.png" alt="LCCT"></a></h1>
        <h1>La Consolacion College Tanauan</h1>
        Tanauan City, Batangas 4232 <br>
        Telephone: (043) 778-1020 <br>
        Fax: (043) 778-8850 <br>
        <h4 style="text-align: left"> User Number: <span>{{$user->user_id}}</span> <br> Name: <span>{{$user->last_name}}, {{$user->first_name}}</span></h4>
        <h3 class="title add">
            <span>Borrowed Books</span> 
        </h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Return Date </th>
                    <th>Penalty </th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0 ; ?>
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->isbn}}</td>
                        <td>{{$book->name}}</td>
                        <td>{{$book->year}}</td>
                        <td>{{$book->borrower()->first()->pivot->return_date}}</td>
                        <td>{{number_format(computeForPenalty($book), 2)}}</td>
                        <?php $total += computeForPenalty($book) ?>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <h4 style="text-align: right"> Total: {{ number_format($total, 2) }} </h4>
    </body>
</html>
