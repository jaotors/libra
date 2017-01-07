<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

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
        $reservations = Reservation::paginate(15);
        return view('borrow.index', compact('reservations'));
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
            $searchQuery = $request->get('search_query');
            $userid = User::where('user_id', $searchQuery)->first();
            $reservations = Reservation::where('user_id', (int)$userid->id)->paginate(15);

            return view('borrow.index', compact('reservations', 'searchQuery'));
        }
    }
}
