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
        $validator = Validator::make($request->all(), [
            'search_query' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $books = Book::where($request->get('search_select'), 'like', "%" . $request->get('search_query') . "%")
                        ->paginate(15);
            return view('opac.index', compact('books', 'categories'));
        }
    }
}
