<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use Session;

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
     * Sets a book for return.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function setForReturn($id)
    {
        $book = Book::findOrFail($id);
        $books = [];
        if (Session::has('books')) {
            $books = Session::get('books');
        }

        array_push($books, $book);

        Session::put('books', $books);
        return redirect()->back();
    }

    /**
     * Return books set for return
     *
     * @return \Illuminate\Http\Response
     */
    public function returnBooks()
    {
        $books = Session::get('books');
    }
}
