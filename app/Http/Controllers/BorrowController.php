<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('admin.borrow.index', compact('books'));
    }

    /**
     * Searches the book resource
     *
     * @param $id
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
            $user = User::findOrFail($id);
            $books = $user->reservations()->get();

            return view('borrow.index', compact('books'));
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
        $book = Book::findOrFail($id);
        $userId = Auth::user()->id;
        $count = Reservation::where('user_id', $userId)->count() + Auth::user()->books()->count();
        $limit = Auth::user()->type == 1 ? config('app.student_number_of_books') : config('app.employee_number_of_books');
        $period = Auth::user()->type == 1 ? config('app.student_borrow_period') : config('app.employee_borrow_period');

        if ($count < $limit) {
            $reservation = Reservation::where('book_id', $book->id)
                                        ->where('user_id', $userId)->first();

            if($book->status == 'Reserved') {
                if($reservation->user_id == Auth::user()->id) {
                    $borrow = new Borrow();

                    $book->status = 'Borrowed';
                    $book->save();

                    $borrow->user_id = $reservation->user_id;
                    $borrow->book_id = $id;
                    $borrow->return_date = date('Y-m-d', strtotime("+$period days"));
                    $borrow->save();

                    $reservation->delete();

                    Session::flash('info_message', 'You have successfuly borrowed the book');
                    return redirect()->back();

                } else {
                    Session::flash('info_message', 'Book has already been reserved');
                    Session::flash('alert-class', 'alert-danger');

                    return redirect()->back();
                }
            }

            if($book->status == 'Available') {
                $borrow = new Borrow();

                $book->status = 'Borrowed';
                $book->save();

                $borrow->user_id = $userId;
                $borrow->book_id = $id;
                $borrow->return_date = date('Y-m-d', strtotime("+$period days"));
                $borrow->save();

                Session::flash('info_message', 'You have successfuly borrowed the book');
                return redirect()->back();

            } else {
                Session::flash('info_message', 'Book is already borrowed');
                Session::flash('alert-class', 'alert-danger');

                return redirect()->back();
            }
        } else {
            Session::flash('info_message', 'Maximum limit of borrowed book reached');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }
    }
}
