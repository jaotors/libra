<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the setting list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        $active_state = 'settings';
        return view('admin.setting.index', compact('settings', 'active_state'));
    }

    /**
     * Displays the edit page of the setting
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        $active_state = 'settings';
        return view('admin.setting.edit', compact('setting', 'active_state'));
    }

    /**
     * Updates setting resource
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'value' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->get('value') == 0) {
                Session::flash('info_message', 'Invalid value');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }

            $id = $request->get('id');

            $setting = Setting::find($id);
            $setting->title = $request->get('title');
            $setting->value = $request->get('value');
            $setting->save();

            Session::flash('info_message', 'Setting Successfuly Updated');
            return redirect()->to('/admin/settings');
        }
    }
}
