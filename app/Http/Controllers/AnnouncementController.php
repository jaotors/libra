<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the announcement list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        $active_state = 'announcements';
        return view('admin.announcement.index', compact('announcements', 'active_state'));
    }

    /**
     * Creates a new announcement resource
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'context' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Announcement::create([
                'title' => $request->get('title'),
                'context' => $request->get('context'),
            ]);

            Session::flash('info_message', 'Announcement Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Deletes the announcement resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();

        Session::flash('info_message', 'Announcement Sucessfuly Deleted');
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
        $announcement = Announcement::findOrFail($id);

        $active_state = 'announcements';
        return view('admin.announcement.edit', compact('announcement', 'active_state'));
    }

    /**
     * Updates announcement resources
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'context' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = $request->get('id');

            $announcement = Announcement::find($id);
            $announcement->title = $request->get('title');
            $announcement->context = $request->get('context');
            $announcement->save();

            Session::flash('info_message', 'Announcement Successfuly Updated');
            return redirect()->to('/admin/announcements');
        }
    }
}
