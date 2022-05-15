<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
 
 

class TagController extends Controller
{
    public function index(){
        $data['tags'] = Tag::latest()->get();
        return view('backend.tag.index', $data);

    }

    public function create(){
        return view('backend.tag.form');

    }

    public function store(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required|string|unique:tags,name|max:50',
            'slug' => 'string|max:255',
        ]);        
        $tag = new Tag;
        $tag->name = $data['name'];
        $tag->slug = Str::slug($data['name']);
        $tag->save();
        Session::flash('success', 'Tag saved successfully.');
        return redirect()->route('tag.index');

    }

    public function edit($slug){
        $data['tag'] = Tag::where('slug', $slug)->first();
        return view('backend.tag.form', $data);

    }

    public function update(Request $request, $slug){
        $tag = Tag::where('slug', $slug)->first();
        $validateData = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $tag->name = $request->name;
        $status = $tag->save();
        if($status){
            Session::flash('success', 'Tag updated successfully.');
            return redirect()->route('tag.index');
        }else{
            Session::flash('error_message', 'sorry ! there was problem while updating this tag.');
            return redirect()->route('tag.index');
        }
    }

    public function delete($slug){
        $tag = Tag::where('slug', $slug)->first();
        // dd($tag);
        $tag->delete();
        return redirect()->back()->with('error', "Tag is deleted successfully.");

    }
}