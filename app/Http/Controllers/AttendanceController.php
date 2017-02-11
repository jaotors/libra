<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Logs in or out the student
     *
     * @param \Illuminate\Http\Request
     * @response \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('user_id', $request->get('user_id'))->first();

        Attendance::create([
            'user_id' => $user->id,
            'type' => 1,
        ]);

        Session::flash('info_message', "Welcome $user->first_name !");
        return redirect()->back();
    }

    /**
     * Logs in or out the student
     *
     * @param \Illuminate\Http\Request
     * @response \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::all();
        $active_state = "active";

        return view('admin.attendance.index', compact('attendances', 'active_state'));
    }
}
