<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
 
 

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::latest()->get();
        return view('backend.category.index', $data);

    }

    public function create(){
        return view('backend.category.form');

    }

    public function store(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required|string|unique:categories,name|max:50',
            'slug' => 'string|max:255',
        ]);
        $category = new Category;
        $category->name = $data['name'];
        $category->slug = Str::slug($data['name']);
        $category->save();
        Session::flash('success', 'Category saved successfully.');
        return redirect()->route('category.index');

    }

    public function edit($slug){
        $data['category'] = Category::where('slug', $slug)->first();
        return view('backend.category.form', $data);

    }

    public function update(Request $request, $slug){
        $category = Category::where('slug', $slug)->first();
        $validateData = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $category->name = $request->name;
        $status = $category->save();
        if($status){
            Session::flash('success', 'Category updated successfully.');
            return redirect()->route('category.index');
        }else{
            Session::flash('error_message', 'sorry ! there was problem while updating this category.');
            return redirect()->route('category.index');
        }
    }

    public function delete($slug){
        $category = Category::where('slug', $slug)->first();
        // dd($category);
        $category->delete();
        return redirect()->back()->with('error', "Category is deleted successfully.");

    }
}