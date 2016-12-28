<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Session;

class CategoryController extends Controller
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
        $categories = Category::paginate(15);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Creates a new category resource
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
            Category::create([
                'name' => $request->get('name'),
            ]);

            Session::flash('info_message', 'Category Successfuly Created');
            return redirect()->back();
        }
    }

    /**
     * Deletes the category resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('info_message', 'Category Sucessfuly Deleted');
        return redirect()->back();
    }

    /**
     * Displays the edit page of the category
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response $response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Updates category resource
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = $request->get('id');

            $category = Category::find($id);
            $category->name = $request->get('name');
            $category->save();

            Session::flash('info_message', 'Category Successfuly Updated');
            return redirect()->to('/admin/categories');
        }
    }
}
