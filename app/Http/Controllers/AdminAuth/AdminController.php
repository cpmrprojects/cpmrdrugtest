<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Session;
use App\Admin;
use \Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){

        return view('admin.home');
    }

    public function disburse(){
        return 'disbursement route';
    }


    public function profile_create(){

        $id = Auth::guard('admin')->id();
        $data['user']  = Admin::where('id',$id)->first();
        
        return view('admin.auth.profile',$data);

    }

    public function update_admin(Request $r){
        $id = Auth::guard('admin')->id();
        $user = Admin::where('id',$id)->first();
        // $this->validate($r, [
        //     'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
        //    ]);
        if ($r->has('select_file')) {
            $image = $r->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $folder = '/admin/img/';
            $filePath = $folder . $new_name;
            
            $image->move(public_path('admin\img'), $new_name); 
            $user->sign_url = $filePath;
        }
            $user->save();
            Session::flash("message", "Profile updated successfully");
            Session::flash("message_title", "success");
            return redirect()->back();
    }

    public function create_admin(Admin $admin){

        $data['admins'] = Admin::all();
        return view('admin.auth.createadmin',$data);
        
    }


}
