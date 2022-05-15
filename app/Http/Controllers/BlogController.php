<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

 

class BlogController extends Controller
{
    public function index(){
        $data['blogs'] = Blog::latest()->with('images', 'blogCategory', 'blogTag')->get();
        return view('backend.blog.index', $data);

    }

    public function create(){
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('backend.blog.form', $data);

    }

    public function store(Request $request){
        $data = $request->all();
        
        $validateData = $request->validate([
            'name' => 'required|string|unique:blogs,name|max:50',
            'slug' => 'string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|integer',
            'status' => 'boolean',
        ]);

        DB::beginTransaction();
        
        try {
            // Interacting with the database
            
            $blog = Blog::create([
                'user_id'=>$request->user_id,
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'description'=>$request->description,
                'status'=>$request->status,
            ]);

            if($request->category_id){
                BlogCategory::create([
                    'blog_id'=>$blog->id,
                    'category_id' => $request->category_id
                ]); 
            }

            if($request->tag_id){
                BlogTag::create([
                    'blog_id'=>$blog->id,
                    'tag_id' => $request->tag_id
                ]);    
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();

                $path = "blog/";
                if(!Storage::exists($path)){
                    Storage::makeDirectory($path, 0755, true, true);
                }
                $file->storeAs('public/blog/',$filename);
                Image::create([
                    'path' => $filename,
                    'imageable_id'=>$blog->id,
                    'imageable_type' => 'App\Models\Blog'
                ]);
            }

            $status = DB::commit();    // Commiting  ==> There is no problem whatsoever
            if($status){
                return redirect()->route('blog.index')->with('success', 'Blog saved successfully.');                    
            }else{
                return redirect()->back()->with('error', 'Sorry ! there was problem while creating blog.');                    
            }

        } catch (\Exception $e) {
            DB::rollback();   // rollbacking  ==> Something went wrong
        }
    }

    public function edit($slug){
        $data['blog'] = Blog::where('slug', $slug)->with('images', 'blogCategory', 'blogTag')->first();
        // dd($data['blog']);
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('backend.blog.form', $data);

    }

    public function update(Request $request, $slug){
        $blog = Blog::where('slug', $slug)->first();
        $data = $request->all();
        
        $validateData = $request->validate([
            'name' => 'required|string|max:50|unique:blogs,name,'.$blog->id,
            'slug' => 'string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|integer',
            'status' => 'boolean',
        ]);

        DB::beginTransaction();
        
        try {
            // Interacting with the database
            
            $blog->update([
                'user_id'=>$request->user_id,
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'description'=>$request->description,
                'status'=>$request->status,
            ]);

            if($request->category_id){
                BlogCategory::where('blog_id', $blog->id)->update([
                    'blog_id'=>$blog->id,
                    'category_id' => $request->category_id
                ]); 
            }

            if($request->tag_id){
                BlogTag::where('blog_id', $blog->id)->update([
                    'blog_id'=>$blog->id,
                    'tag_id' => $request->tag_id
                ]);    
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = md5(rand(945976,1232345)."-".time()).$file->getClientOriginalEstension();
                $path = "blog/";
                if(!Storage::exists($path)){
                    Storage::makeDirectory($path, 0755, true, true);
                }
                $file->storeAs('public/blog/',$filename);
                Image::create([
                    'path' => $filename,
                    'imageable_id'=>$blog->id,
                    'imageable_type' => 'App\Models\Blog'
                ]);
            }

            DB::commit();    // Commiting  ==> There is no problem whatsoever
            return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');                    

        } catch (\Exception $e) {
            DB::rollback();   // rollbacking  ==> Something went wrong
            return redirect()->back()->with('error', 'Sorry ! there was problem while updating blog.');                    
        }
    }

    public function delete($slug){
        $blog = Blog::where('slug', $slug)->first();
        // dd($blog);
        $blog->delete();
        return redirect()->back()->with('error', "Blog is deleted successfully.");

    }
}