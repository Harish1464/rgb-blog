<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\BlogTag;
use App\Models\User;
use Auth;

class FrontEndController extends Controller
{
    public function index(){
        $data['blogs'] = Blog::latest()->with('images', 'blogCategory', 'blogTag')->get();
        return view('frontend.index', $data);
    }

    public function getBlogByCategory($category_slug){
        $category = Category::where('slug', $category_slug)->first();
        $data['blogs'] = array();
        if($category){
            $blog_categories = BlogCategory::where('category_id', $category->id)->latest()->with('blog')->get();
            foreach($blog_categories as $key=>$blog_category){
                $data['blogs'][$key] = $blog_category->blog;
            }
            return view('frontend.index', $data);
        }
    }

    public function getBlogByTag($tag_slug){
        $tag = Tag::where('slug', $tag_slug)->first();
        $data['blogs'] = array();
        if($tag){
            $blog_tags = BlogTag::where('tag_id', $tag->id)->latest()->with('blog')->get();
            foreach($blog_tags as $key=>$blog_tag){
                $data['blogs'][$key] = $blog_tag->blog;
            }
            return view('frontend.index', $data);
        }
    }

    public function login(){
        return view('frontend.auth.login');
    }

    public function registerForm(){
        return view('frontend.auth.register');
    }

    public function registerUser(Request $request)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'name'=> 'required|string|max:100',
            'email'=> 'required|email|max:100',
            'password'=> 'required|string|max:15'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $status = $user->save();
        if($status){
            return redirect()->route('admin.login')->with('success', 'Your account registered successfully. please use the credentials to login.');
        }else{
            return redirect()->back()->with('error', 'sorry, there was problem while registering your account');
        }
        
    }

    public function frontLogin(Request $request){
        $data = $request->all();

        $validatedata = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }

}
