<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the reports
     */
    public function index()
    {
        return view('admin.report.index');
    }

    /**
     * Displays the report page of the users
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function userReport(Request $request)
    {
        switch ($request->type) {
            case 1:
                $users = Role::where('name', 'Student')->first()->user;
                break;
            case 2:
                $users = Role::where('name', 'Librarian')->first()->user;
                break;
            case 3:
                $users = Role::where('name', 'Employee')->first()->user;
                break;
            default:
                $users = User::all();
                break;
        }

        $pdf = PDF::loadView('admin.report.userreport', compact('users'));
        return $pdf->stream();
    }

    /**
     * Displays the report page of the books
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function bookReport(Request $request)
    {
        switch ($request->type) {
            case 1:
                $books = Book::all();
                break;
            case 2:
                $books = Book::onlyTrashed()->get();
                break;
            default:
                $books = Book::withTrashed()->get();
                break;
        }

        $pdf = PDF::loadView('admin.report.bookreport', compact('books'));
        return $pdf->stream();
    }
}
