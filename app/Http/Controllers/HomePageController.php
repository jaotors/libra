<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomePageController extends Controller
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
     * Show the homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all()->sortByDesc('created_at');
        return view('homepage.index', compact('announcements'));
    }
}
