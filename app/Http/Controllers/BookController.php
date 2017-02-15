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
        $books = Book::all();
        $categories = Category::pluck('name', 'id');
        $active_state = 'books';
        return view('admin.book.index', compact('books', 'categories', 'active_state'));
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
            'isbn' => 'required|size:13',
            'call_number' => 'required',
            'publisher' => 'required',
            'material' => 'required',
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
                'call_number' => $request->get('call_number'),
                'publisher' => $request->get('publisher'),
                'material' => $request->get('material'),
                'location' => $request->get('location'),
                'status' => 'Available',
            ]);

            Session::flash('info_message', 'Book Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Displays the delete page of the book
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $book = Book::find($id);
        $remarks = [
            'Damaged' => 'Damaged',
            'Lost Book' => 'Lost Book',
            'Lost Material' => 'Lost Material'
        ];
        $active_state = 'books';
        return view('admin.book.delete', compact('book', 'remarks', 'active_state'));
    }

    /**
     * Deletes the book resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function remove(Request $request) {

        $book = Book::find($request->get('id'));
        if ($book->status == 'Reserved' || $book->status == 'Borrowed') {
            Session::flash('info_message', 'Book is currently Reserved or Borrowed');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else {
            $book->remarks = $request->get('remarks');
            $book->save();
            $book->delete();
            Session::flash('info_message', 'Book Sucessfuly Deleted');
            return redirect()->to('/admin/books');
        }
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

        $active_state = 'books';
        return view('admin.book.edit', compact('book', 'categories', 'status', 'active_state'));

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
            'isbn' => 'required|size:13',
            'call_number' => 'required',
            'publisher' => 'required',
            'material' => 'required',
 
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
            $book->call_number = $request->get('call_number');
            $book->publisher = $request->get('publisher');
            $book->material = $request->get('material');
            $book->location = $request->get('location');
            $book->summary = $request->get('summary');
            $book->category_id = $request->get('category');
            $book->status = $request->get('status');
            $book->save();

            Session::flash('info_message', 'Book Sucessfuly Updated');
            return redirect()->to('/admin/books');
        }
    }

    public function trashIndex()
    {
        $books = Book::onlyTrashed()->paginate(15);
        $categories = Category::pluck('name', 'id');

        $active_state = 'weeds';
        return view('admin.weed.index', compact('books', 'categories', 'active_state'));
    }

    public function trashRestore($id)
    {

        $book = Book::onlyTrashed()->where('id', $id)->first();
        $book->remarks = '';
        $book->save();
        $book->restore();

        Session::flash('info_message', 'Book Sucessfuly Restored');
        return redirect()->to('/admin/weeds');
    }

    /**
     * Export to csv
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

        Book::all()->each(function ($book) use ($csv) {
            $csv->insertOne($book->toArray());
        });

        return $csv->output('books.csv');
    }
}
