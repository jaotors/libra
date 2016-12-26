<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Displays the users list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
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

    /**
     * Displays the edit page of the user
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('admin.user.edit', compact('user', 'roles', 'departments'));
    }

    /**
     * Updates user
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $user = User::find($id);

        //return var_dump("required|unique:users,user_id," . $user->user_id);
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->email, 'email'),
            ],
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->role_id = $request->get('role');
            $user->department_id = $request->get('department');
            $user->user_id = $request->get('user_id');
            $user->email = $request->get('email');
            $user->save();

            Session::flash('info_message', 'User Successfuly Updated');
            return redirect()->to('/admin/users');
        }
    }
}
