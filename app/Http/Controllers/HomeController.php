<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\ReturnHistory;
use App\Models\Reservation;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard depending on the user type
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $role_name = Role::find($user->role_id)->name;

        if ($role_name == "Librarian") {
            return redirect()->to('/admin/');
        } else {
            return redirect()->to('/opac');
        }
    }

    /**
     * Shows the homepage of the application
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage()
    {
        $returns = ReturnHistory::where('is_paid', false)->count();
        $reservationCount = Reservation::all()->count();
        $users = User::where('active', true)->count();
        $active_state = 'homepage';

        return view('admin.homepage', compact('returns', 'reservationCount', 'active_state', 'users'));
    }
}
