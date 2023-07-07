<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class Routing extends Controller
{
    //
    public function showIndex()
    {
        return view('index');
    }

    public function accounts(Request $request)
    {
        if (request()->is('auth/login')) {
            $user = Auth::user();
            if ($user == null) {
                return view('auth.login');
            }
            return redirect("/")->withErrors(['error' => "You are already logged in"]);

        } elseif (request()->is('auth/customer-reg')) {

            $customer = $request->input('customer');
            return view('auth.registration', ['user_type' => $customer]);

        } elseif (request()->is('auth/farmer-reg')) {

            $farmer = $request->input('farmer');
            return view('auth.registration', ['user_type' => $farmer]);

        } elseif (request()->is('auth/reset')) {

            return view('auth.reset_request');

        } else {
            abort(404);
        }
    }

    public function fromMailResetRequest($token)
    {
        if (request()->route()->named('create_reset')) {

            return view('auth.reset_password', ['token' => $token]);

        } elseif (request()->route()->named('request_reset')) {

            return view('auth.reset_password', ['token' => $token]);

        }else {
            abort(404);
        }
    }
}
