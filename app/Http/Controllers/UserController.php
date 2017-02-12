<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;

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
        $active_state = 'users';
        return view('admin.user.index', compact('users', 'roles', 'departments', 'active_state'));
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
            $user = User::create([
                'first_name'  => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'role_id' => $request->get('role'),
                'department_id' => $request->get('department'),
                'email' => $request->get('email'),
                'user_id' => $request->get('user_id'),
                'password' => Hash::make($request->get('user_id')),
                'delinquent' => false,
                'active' => '1',
            ]);

            $user->password = bcrypt($request->get('user_id'));
            $user->save();

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
        $active_state = 'users';
        return view('admin.user.edit', compact('user', 'roles', 'departments', 'active_state'));
    }

    /**
     * Updates user resource
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
            'active' => 'required',
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
            $user->active = $request->get('active');
            $user->delinquent = $request->get('delinquent');
            $user->save();

            Session::flash('info_message', 'User Successfuly Updated');
            return redirect()->to('/admin/users');
        }
    }

    /**
     * Change password of user
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => [
                'required',
            ],
            'new_password' => [
                'required',
            ],
            'repeat_password' => [
                'same:new_password',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                Session::flash('info_message', 'Change password success');
                return redirect()->back();
            } else {
                Session::flash('info_message', 'Old password does not match!');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
        }
    }

    /**
     * Show forgot password form
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function showForgotPassword($id)
    {
        $user = User::findOrFail($id);
        $active_state = 'user';
        return view('admin.user.forgot-password', compact('user', 'active_state'));
    }

    /**
     * Show forgot password form
     *
     * @param $\Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($request->get('id'));
        $user->password = bcrypt($request->get('password'));
        $user->save();

        Session::flash('info_message', 'Change password success');
        return redirect()->to('/admin/users');
    }

    /**
     * Export to csv
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

        User::all()->each(function ($user) use ($csv) {
            $csv->insertOne($user->toArray());
        });

        return $csv->output('users.csv');
    }
}
