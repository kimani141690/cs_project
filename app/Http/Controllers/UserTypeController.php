<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserTypeController extends Controller
{
    //
    public function storeUserType(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:farmer,customer',
        ]);

        $userType = $request->input('user_type');
        session(['user_type' => $userType]);

        return redirect()->route('register');
    }


}
