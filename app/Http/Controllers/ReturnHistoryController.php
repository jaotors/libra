<?php

namespace App\Http\Controllers;

use App\Models\ReturnHistory;
use App\Models\Payment;
use Validator;
use Session;
use PDF;
use Auth;

class ReturnHistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the return history page
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = ReturnHistory::findOrFail($id);
        $books = $return->books()->withPivot('penalty', 'borrowed_date')->get();
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
        $books = $return->books()->withPivot('penalty', 'borrowed_date')->get();
        $user = $return->user()->first();
        $auth = Auth::user();
        $pdf = PDF::loadView('admin.return-history.receipt', compact('books', 'user', 'return', 'auth'));
        return @$pdf->stream();
    }
}
