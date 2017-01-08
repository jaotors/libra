<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
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
        return view('opac.index', compact('books', 'categories'));
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
        $books = Book::where($searchSelect, 'like', "%$searchQuery%")->paginate(15);
        return view('opac.index', compact('books', 'categories', 'searchQuery', 'searchSelect'));
    }
/**
     * Lists all books reserved by the user
     *
     * @return \Illuminate\Http\Response
     */
    public function reservation()
    {
        if (!Auth::check()) {
            return redirect()->to('/login');
        } else {
            $user = Auth::user();
            $books = $user->books();
            return 'pogi ako';
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
        return view('opac.book', compact('book'));
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

    }
}
