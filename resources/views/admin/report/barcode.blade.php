<html>
    <head>
    <title>LCCT - Library System Report - Books</title>
        <style>
            *{
                margin-left: 2px;
                margin-top: 2px;
            }
            .barcode {
                text-align: center;
                width: 30px;
            }
            .real-span {
                margin-right: auto;
                margin-left: auto;
            }
        </style>
    </head>
    <body>
        <div class="content">
            @foreach($books as $book)
                <span class="barcode">
                    {!! DNS1D::getBarcodeHTML($book->call_number, "c128"); !!}
                    &nbsp;&nbsp;{{ $book->isbn }}
                </span>
                <br>
            @endforeach
        </div>
    </body>
</html>
