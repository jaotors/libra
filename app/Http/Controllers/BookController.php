<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class BookController extends Controller
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
        return view('admin.book.index', compact('books', 'categories'));
    }

    /**
     * Creates a new book resource
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'year' => 'required|size:4',
            'author' => 'required',
            'isbn' => 'required|size:13'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Book::create([
                'name' => $request->get('name'),
                'year' => $request->get('year'),
                'author' => $request->get('author'),
                'isbn'  => $request->get('isbn'),
                'summary' => $request->get('summary'),
                'category_id' => $request->get('category'),
                'status' => 'Available',
            ]);

            Session::flash('info_message', 'Book Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Deletes the book resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        Session::flash('info_message', 'Book Sucessfuly Deleted');
        return redirect()->back();
    }

    /**
     * Displays the edit page of the book
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::pluck('name', 'id');
        $status = [
            'Available' => 'Available',
            'Borrowed' => 'Borrowed',
            'Reserved' => 'Reserved',
        ];

        return view('admin.book.edit', compact('book', 'categories', 'status'));

    }

    /**
     * Updates holiday resources
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'year' => 'required|size:4',
            'author' => 'required',
            'isbn' => 'required|size:13'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = Book::find($request->get('id'));
            $book->name = $request->get('name');
            $book->year = $request->get('year');
            $book->author = $request->get('author');
            $book->isbn = $request->get('isbn');
            $book->summary = $request->get('summary');
            $book->category_id = $request->get('category');
            $book->status = $request->get('status');
            $book->save();

            Session::flash('info_message', 'Book Sucessfuly Updated');
            return redirect()->to('/admin/books');
        }
    }
}
