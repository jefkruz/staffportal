<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Department;
use App\Models\JobFamily;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(session('user')){
            return redirect()->route('home');
        }
        $data['page_title'] = 'Login';
        return view('login', $data);
    }

    public function showAdminLogin()
    {
        return view('admin_login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $u = Admin::whereEmailAndStatus($request->email, 'active')->first();
        if(!$u){
            return back()->withInput()->with('error', 'User not found');
        }

        $v = password_verify($request->password, $u->password);
        if(!$v){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        session()->put('admin', $u);
        return to_route('adminDashboard');
    }

    public function login(Request $request)
    {

        $request->validate([
            'portal_id' => 'required',
            'password' => 'required'
        ]);


        $staff = User::where('portalID', $request->portal_id)->where('password',$request->password)->first();

        if(!$staff){

            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        if($staff->enabled == '0'){
            return back()->withInput()->with('error', 'Please check your mailbox for verification link');
        }
        if($staff->enabled == '-1'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }

        if($staff->enabled == '-2'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }
        if($staff->enabled == '-3'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }
        if($staff->enabled == '-5'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }

        session()->put('user', $staff);
        $intendedUrl = session('url.intended', route('home'));
        return redirect($intendedUrl);

    }

    public function logout()
    {
        session()->flush();
        return to_route('login');
    }
}
