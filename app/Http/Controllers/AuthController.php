<?php

namespace App\Http\Controllers;

use App\Mail\verifyEmail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    //---------------------------------------------------------------------------------------
    //login

    public function login()
    {
        return view('auth.login');
    }
    public function showemailpage()
    {
        return view('auth.enteremail');
    }


    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Authentication successful
            if ($user->role == 'Customer') {
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_name', $user->name);

                return redirect()->intended('/customer/index');
            } elseif ($user->role == 'Farmer') {
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_name', $user->name);

                return redirect()->intended('/farmer/index');
            }
            // Customize your logic here, such as redirecting to a dashboard page
            return redirect()->intended('/');
        } else {
            // Authentication failed
            // Customize your logic here, such as redirecting back with a n error message
            return redirect()->back()->withErrors(['loginError' => 'Invalid login credentials']);
        }


    }

    public  function enteremail(Request $request){

//        $user_email = $request->input('email');
        $userInfo = User::all()->where('email', '=', $request->input('email'))->first();
        $user_id =$userInfo->id;

        Mail::to($request->input('email'))->send(new verifyEmail($user_id));
        return redirect('/auth/login');



    }


    public function registrationTypes()
    {
        if (request()->is('auth/customer-reg')) {
            return view('auth.customer_reg');
        } elseif (request()->is('auth/farmer-reg')) {
            return view('auth.farmer_reg');
        }
    }

    public function registration(Request $request)
    {
        $user_type = $request->input('user_type');
        $existinguser = User::where('email', $request->input('email'))->exists();

        if ($user_type == 'farmer') {

            if (!$existinguser) {
                // Create and save the new user
                $user = new User();
                $user->email = $request->input('email');
                $user->name = $request->input('name');
                $user->mobile_no = $request->input('contact');
                $user->role = 'Farmer';
                $password = $request->input('name') . '_smart_farmer_user';
                $user->password = Hash::make($password);
                $user->save();
                $userID = DB::getPdo()->lastInsertId();
                DB::table('Verify_Users')
                    ->insert([
                        'token' => str::random(60),
                        'user_id' => $userID,
                    ]);


//                Mail::to($request->input('email'))->send(new verifyEmail($userID));


                return redirect('/auth/login');

            } else {
                return redirect('/auth/login')->with('message', 'An account with that email already exists. Please login to proceed.');

            }
        } elseif ($user_type == 'customer') {

            if (!$existinguser) {
                // Create and save the new user
                $user = new User();
                $user->email = $request->input('email');
                $user->name = $request->input('name');
                $user->mobile_no = $request->input('contact');
                $user->role = 'Customer';
                $password = $request->input('name') . '_smart_farmer_user';
                $user->password = Hash::make($password);
                $user->save();

                $userID = DB::getPdo()->lastInsertId();
                DB::table('Verify_Users')
                    ->insert([
                        'token' => str::random(60),
                        'user_id' => $userID,
                    ]);


//                Mail::to($request->input('email'))->send(new verifyEmail($userID));

                return redirect('/auth/login');

            } else {
                return redirect('/auth/login')->with('message', 'An account with that email already exists. Please login to proceed.');

            }

        }
    }

    public
    function validatelogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return redirect(route('user.login'))->with('message', 'please verify your account to continue.');

            }
            //intened dasboard
            return redirect(route('index'))->with('success', 'logged in successfully');
        }
//        $request->validate([
//            'email' => 'required',
//            'password' => 'required',
//        ]);
//
//        $credentials = $request->only('email', 'password');
//        if (Auth::attempt($credentials)) {
//            return redirect()->intended('dashboard')
//                ->with('message', 'Signed in!');
//        }
//
//        return redirect('/login')->with('message', 'Login details are not valid!');
//    }
    }


    public function verifyEmail($token)
    {
        $verifieduser = VerifyUser::where('token', $token)->first();
        if (isset($verifieduser)) {

            $user = $verifieduser->user_id;
            if (!$user->email_verified_at) {
                $user->email_verified_at = carbon::now();
                $user->save();

                return redirect(route('user.login'))->with('success', 'Your email has been verified');

            } else {

                return redirect()->back()->with('info', 'Your email has already been verified');
            }
        } else {

            return redirect(route('user.login'))->with('error', 'Something went wrong !!');
        }
    }

//--------------------------------------------------------------------------------------------------------------
//password reset
    public
    function PasswordReset($user_id)
    {

        return view('auth.resetpassword', ['user_id' => $user_id]);
    }

    public function passwordupdate(Request $request)
    {
        $newpassword = Hash::make($request->input('new_password'));
        $user_update = User::all()->where('id', '=', $request->input('user_id'))->first();
        $user_update->password = $newpassword;
        $user_update->email_verified_at = Carbon::now();
        $user_update->update();
        return redirect('/auth/login')->withErrors(['msg' => 'Password Reset Successfully.']);
    }

//----------------------------------------------------------------------------------------------------------------
//logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
