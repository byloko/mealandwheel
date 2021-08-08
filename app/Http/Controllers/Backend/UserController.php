<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use File;
use Auth;


class UserController extends Controller
{
   
    public function user_index(Request $request)
    {
        $getrecord = User::where('is_admin','=', 0)->orderBy('id', 'desc');
        // Search box start
        if ($request->idsss) {
            $getrecord = $getrecord->where('users.id', '=', $request->idsss);
        }
        if ($request->name) {
            $getrecord = $getrecord->where('users.name', 'like', '%' . $request->name . '%');
        }
        if ($request->lastname) {
            $getrecord = $getrecord->where('users.lastname', 'like', '%' . $request->lastname . '%');
        }
        if ($request->email) {
            $getrecord = $getrecord->where('users.email', 'like', '%' . $request->email . '%');
        }
        if ($request->mobile) {
            $getrecord = $getrecord->where('users.mobile', 'like', '%' . $request->mobile . '%');
        }
        // Search box end
        $getrecord = $getrecord->paginate(40);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = 'User List';
        return view('backend.user.list', $data);
    }

    public function user_create()
    {
         $data['meta_title'] = 'Add User';
        return view('backend.user.add', $data);
    }
    
    public function user_store(Request $request)
    {
         $store_user = request()->validate([
            'email'     => 'required|unique:users',
            'password'  => 'required',
            //'name'      => 'required|unique:users',
            'mobile'    => 'required|min:10|unique:users',
        ]);
        $store_user                     = new User;
        $store_user->name               = $request->name;
        $store_user->lastname           = $request->lastname;
        $store_user->password           = Hash::make($request->password);
        $store_user->email              = $request->email;
        $store_user->mobile             = $request->mobile;
       
        if (!empty($request->file('user_profile'))){
            $ext = 'jpg';
            $file = $request->file('user_profile');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $store_user->user_profile = $filename;
        }

        $store_user->address            = $request->address;
        $store_user->city               = $request->city;
        $store_user->state              = $request->state;
        $store_user->country            = $request->country;
        $store_user->postcode           = $request->postcode;
        $store_user->save();
        return redirect('admin/user')->with('success', 'Record created successfully!');

    }

    public function user_show($id)
    {
        $data['getrecord'] = User::get_single($id);
        $data['meta_title'] = 'View User';
        return view('backend.user.view', $data);
    }

    
    public function user_edit($id)
    {
        $data['getrecord'] = User::get_single($id);
        $data['meta_title'] = 'Edit User';
        return view('backend.user.edit', $data);
    }

   
    public function user_update(Request $request, $id)
    {
         $user_update = User::find($id);
        if(!empty($request->password)){
            $user_update->password = Hash::make($request->password);
        }
        $user_update->name           = $request->name;
        $user_update->lastname       = $request->lastname;
        
        if (!empty($request->file('user_profile')))
        {
            if (!empty($user_update->user_profile) && file_exists('upload/profile/'.$user_update->user_profile))
            {
                unlink('upload/profile/'.$user_update->user_profile);
            }
            $ext = 'jpg';
            $file = $request->file('user_profile');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $user_update->user_profile = $filename;
        }

        $user_update->email        = $request->email;
        $user_update->address      = $request->address;
        $user_update->city         = $request->city;
        $user_update->state        = $request->state;
        $user_update->country      = $request->country;
        $user_update->postcode     = $request->postcode;
        $user_update->mobile       = $request->mobile;
      
        
        $user_update->save();
        return redirect('admin/user')->with('success', 'Record updated Successfully!');
    }

   
    public function user_destroy($id)
    {
        $destroy_user = User::get_single($id);
        $destroy_user->delete();
        return redirect()->back()->with('error', 'Record successfully deleted!');
    }
}
