<?php
/**
 * Created by PhpStorm.
 * User: jramos
 * Date: 30/11/2016
 * Time: 3:47 PM
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Displays the user's list
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('admin.user.index', compact('users', 'roles', 'departments'));
    }
    
    /**
     * Creates a new user
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response $response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            User::create([
                'first_name'  => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'role_id' => $request->get('role'),
                'department_id' => $request->get('department'),
                'email' => $request->get('email'),
                'user_id' => $request->get('user_id'),
                'password' => bcrypt($request->get('password')),
            ]);
            
            Session::flash('info_message', 'User Successfuly Created');
            return redirect()->back();
        }
    }
}