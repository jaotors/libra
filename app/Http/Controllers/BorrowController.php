<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use PDF;
use App\Models\Log;
use App\Models\Holidays;

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
        $histories = [];
        $user = null;

        $active_state = 'borrow';
        return view('admin.borrow.index', compact('books', 'user', 'active_state', 'histories'));
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
            'search_query' => 'required',
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

            $histories = $user->history()->where('is_paid', false)->with('books')->get();
            $books = $user->reservations()->get();

            $active_state = 'borrow';
            return view('admin.borrow.index', compact('books', 'user', 'active_state', 'histories'));
        }
    }

    /**
     * Borrows the book resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function borrow($id)
    {

        $user = User::findOrFail($id);

        if ($user->hasDues()) {
            Session::flash('info_message', 'You have outstanding due\'s. please settle first your penalties');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        $books = $user->reservations()->get();

        $studentNumberOfBooks = Setting::where('title', 'Student Books')->first()->value;
        $employeeNumberOfBooks = Setting::where('title', 'Employee Books')->first()->value;
        $studentBorrowPeriod = Setting::where('title', 'Student Duration')->first()->value;
        $employeeBorrowPeriod = Setting::where('title', 'Employee Duration')->first()->value;
        
        $count = Reservation::where('user_id', $user->id)->count() + $user->books()->count();
        $limit = $user->role_id == 1 ? $studentNumberOfBooks : $employeeNumberOfBooks;
        $period = $user->role_id == 1 ? $studentBorrowPeriod : $employeeBorrowPeriod;

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
            $return_date = date('Y-m-d', strtotime("+$period days"));
            while (!$this->isValidReturnDate($return_date)) {
                $return_date = date('Y-m-d', strtotime("$return_date +1 days"));
            }
            $borrow->return_date = $return_date;
            $borrow->save();
        }

        $logs = new Log();
        $logs->user_id = $user->id;
        $logs->role_id = $user->role_id;
        $logs->action = "Borrow";
        $logs->save();

        Session::flash('info_message', 'You have successfuly borrowed the book');
        return redirect()->to("/admin/user/$user->id/book");
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
            'isbn' => 'required|exists:books',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($request->get('user_id'));
        if ($user->hasDues()) {
            Session::flash('info_message', 'You have outstanding due\'s. please settle first your penalties');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }
        $isbn = $request->get('isbn');
        $book = Book::where('isbn', "$isbn")->first();
        $count = Reservation::where('user_id', $user->id)->count() + $user->books()->count();
        $studentBooks = Setting::where('title', 'Student Books')->first();
        $employeeBooks = Setting::where('title', 'Employee Books')->first();
        $limit = $user->role_id == 1 ? $studentBooks->value : $employeeBooks->value;

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

    /**
     * Prints the receipt needed after borrowing the book
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function printReceipt($id)
    {
        $user = User::findOrFail($id);
        $books = $user->books()->get();
        $auth = Auth::user();
        $pdf = PDF::loadView('admin.borrow.receipt', compact('books', 'user', 'auth'));

        return @$pdf->stream();
    }

    /**
     * Computes for the valid returnDate
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    private function isValidReturnDate($date)
    {
        $holidays = Holiday::all();
        $date = new \DateTime($date);

        if ($date->format('N') > 6) {
            return false;
        }

        foreach ($holidays as $holiday) {
            $holiday_date = new \DateTime($holiday->date);

            if ($holiday_date->format('Y-m-d') == $date->format('Y-m-d')) {
                return false;
            }
        }

        return true;
    }
}
