<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display's the departments list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::paginate(15);
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Creates a new department resource
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Department::create([
                'name' => $request->get('name'),
            ]);

            Session::flash('info_message', 'Department Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Deletes the department resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();

        Session::flash('info_message', 'Department Sucessfuly Deleted');
        return redirect()->back();
    }
}
