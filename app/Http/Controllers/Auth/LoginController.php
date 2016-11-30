<?php
/**
 * Created by PhpStorm.
 * User: jramos
 * Date: 30/11/2016
 * Time: 11:01 AM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    /**
     * Shows the login page
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'password' => 'required'
        ]);

        if(!$validator->fails()) {

            $user_id = $request->get('user_id');
            $password = $request->get('password');

            if (Auth::attempt(['user_id' => $user_id, 'password' => $password])) {
                return redirect()->intended('welcome');
            } else {
                $validator->errors()->add('login', 'Invalid login credentials');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

        } else {
            $validator->errors()->add('login', 'Invalid login credentials');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}