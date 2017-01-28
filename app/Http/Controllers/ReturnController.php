<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\ReturnModel;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use Session;
use PDF;

class ReturnController extends Controller
{

    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the return page
     * * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $books = [];
        $user = null;
        Session::forget('books');
        return view('admin.return.index', compact('books', 'user'));
    }

    /**
     * Searches the user for the book
     *
     * @return \Illuminate\Http\Response $response
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_query' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = $request->get('search_query');
            $user = User::where('user_id', $id)->first();

            if (is_null($user)) {
                Session::flash('info_message', 'User not found');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }

            $books = $user->borrowed()->get();

            return view('admin.return.index', compact('books', 'user'));
        }
    }

    /**
     * Return books set for return
     *
     * @return \Illuminate\Http\Response
     */
    public function returnBooks(Request $request)
    {
        $books = $request->get('books');

        $return = new ReturnModel();

        $penalties = 0;
        
        foreach ($books as $id) {
            $book = Book::findOrFail($id);
            $book->status = "Available";
            $book->save();
            $penalties += computeForPenalty($book);
        }

        if ($penalties != 0) {
            $return->has_penalty = true;
            $return->is_paid = false;
        } else {
            $return->is_paid = true;
            $return->has_penalty = true;
        }

        $return->save();

        foreach ($books as $id) {
            $book = Book::findOrFail($id);
            $return->books()->attach($book->id, ['penalty' => computeForPenalty($book)]);
            $borrow = Borrow::where('book_id', $book->id);
            $borrow->delete();
        }

        Session::flash('info_message', 'Books have been return succesfuly');
        return redirect()->back();
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
        $books = Session::get('books');

        $user = User::findOrFail($id);

        $pdf = PDF::loadView('admin.return.receipt', compact('books', 'user'));
        return $pdf->stream();
    }
}
