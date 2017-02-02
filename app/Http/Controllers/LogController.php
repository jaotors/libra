<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the category list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::paginate(15);
        $active_state = 'logs';
        return view('admin.log.index', compact('logs', 'active_state'));
    }
}
