<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\ReturnModel;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Validator;
use Session;
use PDF;

class ReturnHistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the return history page
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $returns = ReturnModel::all();
        return view('admin.return-history.index', compact('returns'));
    }
}
