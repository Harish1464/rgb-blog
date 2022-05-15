<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Str;
use App\Models\Admin;

class USerProfileController extends Controller
{
    public function userProfile()
    {
        $data['admin'] = Auth::guard('admin')->user();
        return view('backend.user-profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'address'=> 'nullable|string',
            'image'=> 'nullable|image|mimes:jpeg,jpg,png,gif',
            'phone'=> 'nullable|string|max:10',
            'status'=> 'nullable',
            'role'=> 'nullable',
        ]);
        $admin_id = Auth::guard('admin')->user()->id;
        $admin = Admin::findOrFail($admin_id);
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->phone = $data['phone'];
        $admin->address = $data['address'];
        $admin->status = $data['status'];
        $admin->role = $data['role'];
        if ($image = $request->file('image')) {
            $imageDestinationPath = '/uploads';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $img = Image::make($image);
            $img->resize(128,128, function ($constraint) {
                $constraint->aspectRatio();
            })->save($imageDestinationPath.$postImage); 
            // Save In Database
            $admin->image= "$postImage";
        }
        $admin->save();
        Session::flash('success_message', 'Admin profile hasbeen updated successfully.');
        return redirect()->back();
    }

    public function changePassword()
    {
        $user_info = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('backend.changePassword', compact('user_info'));
    }

    //checking current password

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_id = Auth::guard('admin')->user()->id;
        $user_info = Admin::where('id', $user_id)->first();
        if(Hash::check($current_password, $user_info->password)){
            return "true"; die;
        }else{
            return "false"; die;
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'current_password' => 'required|max:255|min:6',
            'password' => 'required|confirmed|min:6',
            // 'password_confirmation' => 'required|min:6|same:password',
         
        ]);
        $old_password = $data['current_password'];
        $new_password = $data['password'];
        $password_confirmation = $data['password_confirmation'];
        
        $user = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $current_user_password = $user->password;
        if(Hash::check($old_password, $current_user_password)){
            if($new_password == $password_confirmation){
                $user->password = bcrypt($new_password);
                $user->save();
                Session::flash('success_message', 'Your Password changed successfully.');
                return redirect()->route('adminLogout');
            }else{
                Session::flash('error_message', 'Sorry ! new password and confirm password deoesnot matches. ');
                return redirect()->back();
            }
        }else{
            Session::flash('error_message', 'Sorry ! your current password does not matches with our database.');
            return redirect()->back();
        }
    }
}