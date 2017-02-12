<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Book;
use League\Csv\Reader;
use Session;

class ImportController extends Controller
{

    /**
     *  Shows the upload form
     *
     *  @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_state = 'upload';
        return view('admin.import.index', compact('active_state'));
    }

    /**
     * Imports the uploaded csv and saves the records in the database
     *
     * @param \Illuminate\Http\Request;
     *
     * @return \Illuminate\Http\Response;
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $type = $request->get('type');
        $file = $request->file('file');

        $destinationPath = 'uploads';
        $originalName = $file->getClientOriginalName();
        $file->move($destinationPath, $originalName);
 
        if ($type == 0) {
            $users = User::all();

            foreach ($users as $user) {
                $user->active = false;
                $user->save();
            }
            $csv = Reader::createFromPath("uploads/$originalName");
            $res = $csv->fetchAll();
            for ($index = 0; $index < count($res); ++$index) {
                $row = $res[$index];
                $user = User::find($row[0]);

                if ($user) {
                    $user->active = true;
                    $user->save();
                } else {
                    $user = User::create([
                        'email' => $row[1],
                        'user_id' => $row[4],
                        'first_name' => $row[5],
                        'last_name' => $row[6],
                        'role_id' => $row[7],
                        'department_id' => $row[7],
                        'active' => true,
                        'delinquent' => 0,
                        'password' => bcrypt($row[4]),
                    ]);

                    $user->password = $row[4];
                    $user->save();
                }
            }
        } else {
            $csv = Reader::createFromPath("uploads/$originalName");
            $res = $csv->fetchAll();
            return var_dump($res);
            for ($index = 0; $index < count($res); ++$index) {
                $row = $res[$index];
                Book::create([
                    'name' => $row[1],
                    'year' => $row[2],
                    'isbn' => $row[3],
                    'call_number' => $row[11],
                    'author' => $row[4],
                    'summary' => $row[8],
                    'publisher' => $row[13],
                    'material' => $row[12],
                    'location' => $row[14],
                    'category_id' => $row[9],
                    'status' => $row[10],
                ]);
            }
        }
        Session::flash('info_message', 'Import Succesful');
        return redirect()->back();
    }
}
