<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Book;
use App\Models\Payment;
use App\Models\ReturnHistory;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;
use PDF;
use Auth;

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
        $active_state = 'reports';
        return view('admin.report.index', compact('active_state'));
    }

    /**
     * Displays the report page of the users
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function userReport(Request $request)
    {
        $auth = Auth::user();

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

        $pdf = PDF::loadView('admin.report.userreport', compact('users', 'auth'));
        return @$pdf->stream();
    }

    /**
     * Displays the report page of the books
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function bookReport(Request $request)
    {
        $auth = Auth::user();

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

        $pdf = PDF::loadView('admin.report.bookreport', compact('books', 'auth'));
        return @$pdf->stream();
    }

    /**
     * Displays the barcode of books for printing
     *
     * @return  \Illuminate\Http\Response
     */
    public function bookBarcodeReport(Request $request)
    {
        $books = Book::all();
        $pdf = PDF::loadView('admin.report.barcode', compact('books'));

        return @$pdf->stream();
    }

    /**
     * Displays the returns report
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     **/
    public function returnsReport(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $auth = Auth::user();

        $returns = ReturnHistory::whereBetween('created_at', [$from, $to])->get();
        $pdf = PDF::loadView('admin.report.returns', compact('returns', 'auth', 'from', 'to'));
        return @$pdf->stream();
    }

    /**
     * Displays the payments report
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     **/
    public function paymentsReport(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $auth = Auth::user();

        $payments = Payment::whereBetween('created_at', [$from, $to])->get();
        $pdf = PDF::loadView('admin.report.payment', compact('payments', 'auth', 'from', 'to'));
        return @$pdf->stream();
    }

    /**
     * Displays the payments report
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     **/
    public function logsReport(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $auth = Auth::user();

        $logs = Log::whereBetween('created_at', [$from, $to])->get();
        $pdf = PDF::loadView('admin.report.log', compact('logs', 'auth', 'from', 'to'));
        return @$pdf->stream();
    }
}
