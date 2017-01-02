<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class OpacController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the book list
     *
     * @return \Illuminate\Http\Response $response
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
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function search(Request $request)
    {
        $searchQuery = $request->get('search_query');
        $searchSelect = $request->get('search_select');
        $books = Book::where($searchSelect, 'like', "%$searchQuery%")->paginate(15);
        return view('opac.index', compact('books', 'categories', 'searchQuery', 'searchSelect'));
    }
}
