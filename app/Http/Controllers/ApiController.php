<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function verify(Request $request)
    {
        $request->validate([
            'portal_id' => 'required',
            'password' => 'required'
        ]);


        $staff = User::where('portalID', $request->portal_id)->where('password',$request->password)->first();
        if ($staff){
            return response(['status' => true]);

        }
        else{
            return response(['status' => false]);
        }
    }
}
