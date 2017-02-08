<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;

class BorrowController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the book with user list
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $books = [];
        $user = null;

        $active_state = 'borrow';
        return view('admin.borrow.index', compact('books', 'user', 'active_state'));
    }

    /**
     * Searches the book resource
     *
     * @param \Illuminate\Http\Request $request
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

            $books = $user->reservations()->get();

            $active_state = 'borrow';
            return view('admin.borrow.index', compact('books', 'user', 'active_state'));
        }
    }

    /**
     * borrow the book resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function borrow($id)
    {

        $user = User::findOrFail($id);
        $books = $user->reservations()->get();

        $count = Reservation::where('user_id', $user->id)->count() + $user->books()->count();
        $limit = $user->type == 1 ? config('app.student_number_of_books') : config('app.employee_number_of_books');
        $period = $user->type == 1 ? config('app.student_borrow_period') : config('app.employee_borrow_period');

        if ($count > $limit) {
            Session::flash('info_message', 'Maximum limit of borrowed book reached');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        foreach ($books as $book) {
            $reservation = Reservation::where('book_id', $book->id)->where('user_id', $user->id)->first();
            $reservation->delete();

            $borrow = new Borrow();
            $book->status = 'Borrowed';
            $book->save();

            $borrow->user_id = $user->id;
            $borrow->book_id = $book->id;
            $borrow->return_date = date('Y-m-d', strtotime("+$period days"));
            $borrow->save();
        }

        Session::flash('info_message', 'You have successfuly borrowed the book');
        return redirect()->back();
    }

    /**
     * Reserve the book
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     *
     */
    public function reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|numeric',
        ]);

        $user = User::findOrFail($request->get('user_id'));
        $isbn = $request->get('isbn');
        $book = Book::where('isbn', "$isbn")->first();
        $count = Reservation::where('user_id', $user->id)->count() + $user->books()->count();
        $limit = $user->type == 1 ? config('app.student_number_of_books') : config('app.employee_number_of_books');

        if ($count < $limit) {
            $reservation = new Reservation();

            if ($book->status == 'Available') {
                $book->status = 'Reserved';
                $book->save();

                $reservation->user_id = $user->id;
                $reservation->book_id = $book->id;
                $reservation->save();

                Session::flash('info_message', 'Book has been reserved');
                return redirect()->back();
            } else {
                Session::flash('info_message', 'Book has already been reserved');
                Session::flash('alert-class', 'alert-danger');

                return redirect()->back();
            }
        } else {
            Session::flash('info_message', 'Maximum limit of borrowed book reached');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }
    }

    /**
     * Remove a book from a reservation
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response @reponse
     */
    public function remove(Request $request)
    {
        $book = Book::findOrFail($request->get('id'));
        $book->status = 'Available';
        $book->save();

        $user = User::findOrFail($request->get('user_id'));
        $reservation = Reservation::where('user_id', $user->id)->where('book_id', $book->id)->first();

        $reservation->delete();

        Session::flash('info_message', 'Book succesfuly removed from reservation');
        return redirect()->back();
    }
}
