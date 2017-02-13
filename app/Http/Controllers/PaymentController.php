<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Payment;
use App\Models\ReturnHistory;
use Validator;
use Session;

class PaymentController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays all the payments
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        $active_state = "payment";
        return view('admin.payment.index', compact('payments', 'active_state'));
    }

    /**
     * Sets the status of return history to paid and creates a payment resource
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'or_number' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $id = $request->get('id');
        $returnHistory = ReturnHistory::findOrFail($id);
        $returnHistory->is_paid = true;
        $returnHistory->save();

        Payment::create([
            'user_id' => $returnHistory->user_id,
            'return_history_id' => $returnHistory->id,
            'amount' => $request->get('amount'),
            'or_number' => $request->get('or_number'),
            'payment_date' => $request->get('date'),
        ]);

        Session::flash('info_message', 'Payment Succesful!');
        return redirect()->back();
    }
}
