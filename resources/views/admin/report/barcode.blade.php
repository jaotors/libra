<html>
    <head>
    <title>LCCT - Library System Report - Books</title>
        <style>
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
                    {!! DNS1D::getBarcodeHTML($book->isbn, "C128", 1, 100); !!}
                    &nbsp;&nbsp;{{ $book->isbn }}
                </span>
                <br>
            @endforeach
        </div>
    </body>
</html>
