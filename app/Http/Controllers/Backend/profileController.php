<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class profileController extends Controller
{
    public function view()
    {
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('backend.user.view-profile', compact('user'));
    }

    public function edit()
    {
    	$id = Auth::user()->id;
    	$editData = User::find($id);
    	return view('backend.user.edit-profile', compact('editData'));
    }

    
    public function update(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name   = $request->name;
        $data->email  = $request->email;
        $data->mobile = $request->mobile;
        $data->address= $request->address;
        $data->gender = $request->gender;
        
          if ($request->file('image')) {
          	 $file = $request->file('image');
          	 
          	 $filename =time() . '.' . $file->getClientOriginalExtension();

          	 $file->move('upload').$filename;
          	 $data['image']=$filename;
          }
        $data->save();
        return redirect()->route('profile.view');
    }

    public function passwordView(){

        return view('backend.user.edit-password');
    }

    public function passwordUpdate(Request $request){
         if (Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])) {
           $user = User::find(Auth::user()->id);
           $user->password = bcrypt($request->new_password);
           $user->save();
           return redirect()->route('users.view')->with('success', 'Password Updated Successfully!!');
         }else{
          return redirect()->back()->with('error', 'Sorry Your current Password does not match');
         }
    }
}
