<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;
use Auth;

class OpacController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the book list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(15);
        $categories = Category::pluck('name', 'id');
        $categories->prepend("Choose One", -1);
        $user = Auth::user();

        $reservations = [];
        $histories = [];
        $booksBorrowed = [];
        
        if (Auth::check()) {
            $reservations = $user->reservations()->get();
            $histories = $user->history()->orderBy('created_at', 'DESC')->with('books')->get();
            $booksBorrowed = $user->borrowed()->get();
        }

        return view('opac.index', compact('books', 'categories', 'reservations', 'histories', 'booksBorrowed'));
    }

    /**
     * Searches the book resource
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchQuery = $request->get('search_query');
        $searchSelect = $request->get('search_select');
        $books = Book::where($searchSelect, 'like', "%$searchQuery%");
        $material = $request->get('material');
        $status = $request->get('status');
        $category = $request->get('category');

        if (isset($material) && $material != -1) {
            $books = $books->where('material', $material);
        }

        if (isset($category) && $category != -1) {
            $category = Category::findOrFail($category);
            $books = $books->where('category_id', $category->id);
        }

        if (isset($status) && $status != -1) {
            $book = $books->where('status', $status);
        }

        $books = $books->paginate(15);
        $categories = Category::pluck('name', 'id');
        $categories->prepend("Choose One", -1);
        $user = Auth::user();

        $reservations = [];
        $histories = [];
        $booksBorrowed = [];
        
        if (Auth::check()) {
            $reservations = $user->reservations()->get();
            $histories = $user->history()->orderBy('created_at', 'DESC')->get();
            $booksBorrowed = $user->borrowed()->get();
        }

        $request->flash();

        return view('opac.index', compact('books', 'categories', 'searchQuery', 'searchSelect', 'reservations', 'histories', 'booksBorrowed'));
    }

    /**
     * Lists all books reserved by the user
     *
     * @return \Illuminate\Http\Response
     */
    public function reservation()
    {
        $reservations = [];
        $histories = [];
        $booksBorrowed = [];

        if (!Auth::check()) {
            return redirect()->to('/login');
        } else {
            $user = Auth::user();
            $books = $user->reservations()->get();

            return view('opac.reservation', compact('books', 'reservation', 'histories', 'booksBorrowed'));
        }
    }

    /**
     * Displays information about the book resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function book($id)
    {
        $book = Book::findOrFail($id);
        $book->category = $book->category()->first()->name;
        return json_encode($book);
    }

    /**
     * Reserve the book
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     *
     */
    public function reserve($id)
    {
        $book = Book::findOrFail($id);
        $userId = Auth::user()->id;
        $count = Reservation::where('user_id', $userId)->count() + Auth::user()->books()->count();
        $studentNumber = Setting::where('title', 'Student Books')->first();
        $employeeBooks = Setting::where('title', 'Employee Books')->first();
        $limit = Auth::user()->role_id == 1 ? $studentBooks->value : $employeeBooks->value;

        if ($count < $limit) {
            $reservation = new Reservation();

            if ($book->status == 'Available') {
                $book->status = 'Reserved';
                $book->save();

                $reservation->user_id = $userId;
                $reservation->book_id = $id;
                $reservation->save();

                Session::flash('info_message', 'Book reservation successful');
                return redirect()->to('/opac');
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
     * @return \Illuminate\Http\Response $response
     *
     */
    public function remove($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 'Available';
        $book->save();

        $user = Auth::user();
        $reservation = Reservation::where('user_id', $user->id)->where('book_id', $book->id)->first();

        $reservation->delete();

        Session::flash('info_message', 'Book succesfuly removed from reservation');
        return redirect()->back();
    }
}
