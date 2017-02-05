<?php
namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the holiday list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = Holiday::all();
        $types = [
            'regular' => 'Regular',
            'special_non_working' => 'Special non-working',
        ];

        $active_state = 'holidays';
        return view('admin.holiday.index', compact('holidays', 'types', 'active_state'));
    }

    /**
     * Creates a new holiday resource
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Holiday::create([
                'name' => $request->get('name'),
                'date' => $request->get('date'),
                'type' => $request->get('type'),
            ]);

            Session::flash('info_message', 'Holiday Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Deletes the holiday resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $holiday = Holiday::find($id);
        $holiday->delete();

        Session::flash('info_message', 'Holiday Sucessfuly Deleted');
        return redirect()->back();
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
        $holiday = Holiday::findOrFail($id);
        $types = [
            'regular' => 'Regular',
            'special_non_working' => 'Special non-working',
        ];

        $active_state = 'holidays';
        return view('admin.holiday.edit', compact('holiday', 'types', 'active_state'));
    }

    /**
     * Updates holiday resources
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = $request->get('id');

            $holiday = Holiday::find($id);
            $holiday->name = $request->get('name');
            $holiday->date = $request->get('date');
            $holiday->type = $request->get('type');
            $holiday->save();

            Session::flash('info_message', 'Holiday Successfuly Updated');
            return redirect()->to('/admin/holidays');
        }
    }
}
