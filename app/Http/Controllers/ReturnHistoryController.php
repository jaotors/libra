<?php

namespace App\Http\Controllers;

use App\Models\ReturnHistory;
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
        $pdf = PDF::loadView('admin.return-history.receipt', compact('books', 'user', 'return'));
        return $pdf->stream();
    }

    /**
     * Sets the status of return history to paid
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        $returnHistory = ReturnHistory::find($id);
        $returnHistory->is_paid = true;
        $returnHistory->save();
        Session::flash('info_message', 'Payment Succesful!');
        return redirect()->back();
    }
}
