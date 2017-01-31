<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\ReturnHistory;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use Session;
use PDF;

class ReturnHistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the return history page
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $returns = ReturnHistory::all();
        $active_state = 'return-history';
        return view('admin.return-history.index', compact('returns', 'active_state'));
    }

    /**
     * Displays the return history page
     *
     * @return \Illuminate\Http\Response $response
     */
    public function show($id)
    {
        $return = ReturnHistory::findOrFail($id);
        $books = $return->books()->withPivot('penalty')->get();
        $active_state = 'return-history';
        return view('admin.return-history.show', compact('return', 'books', 'active_state'));
    }

    /**
     * Prints the receipt needed after borrowing the book
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function printReceipt($id)
    {
        $return = ReturnHistory::findOrFail($id);
        $books = $return->books()->withPivot('penalty')->get();
 
        $user = $return->books()->first();

        $pdf = PDF::loadView('admin.return.receipt', compact('books', 'user'));
        return $pdf->stream();
    }
}
