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

class ReturnController extends Controller
{

    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the return page
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $books = [];
        $user = null;
        Session::forget('books');
        $active_state = 'return';
        return view('admin.return.index', compact('books', 'user', 'active_state'));
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

            $active_state = 'return';
            return view('admin.return.index', compact('books', 'user', 'active_state'));
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
        $return = new ReturnHistory();
        $dateBorrowed = date('Y-m-d');
        $penalties = 0;
        $userId = $request->get('user_id');

        if (is_null($books)) {
            Session::flash('info_message', 'No selected books for return');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        foreach ($books as $id) {
            $book = Book::findOrFail($id);
            $book->status = "Available";
            $book->save();
            $penalties += computeForPenalty($book);
        }

        if ($penalties != 0) {
            $return->is_paid = false;
        } else {
            $return->is_paid = true;
        }

        $return->user_id = $userId;
        $return->save();

        foreach ($books as $id) {
            $book = Book::findOrFail($id);
            $dateBorrowed = $book->borrower()->first()->pivot->created_at;
            $return->books()->attach($book->id, ['penalty' => computeForPenalty($book), 'borrowed_date' => $dateBorrowed]);
            $borrow = Borrow::where('book_id', $book->id);
            $borrow->delete();
        }

        Session::flash('info_message', 'Books have been return succesfuly');
        return redirect()->to("/admin/return-history/$return->id");
    }
}
