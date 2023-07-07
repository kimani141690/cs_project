<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Mail\ResetRequestMail;
use App\Mail\verifyEmail;
use App\Models\PasswordReset;
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


    //1. login

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

    //2. registration and respective email verifications and password resets
    public function registration(Request $request)
    {
        $user_type = $request->input('user_type');
        $existinguser = User::where('email', $request->input('email'))->exists();

        if ($user_type == 'farmer') {

            if (!$existinguser) {
                // Create and save the new user
                $user = new User();
                $user->email = $request->input('email');
                $user->username = $request->input('username');
                $user->role = 'Farmer';
                $password = $request->input('username') . '_smart_farmer_user';
                $user->password = Hash::make($password);
                $user->save();
                $userID = DB::getPdo()->lastInsertId();
                DB::table('password_resets')
                    ->insert([
                        'token' => str::random(60),
                        'user_id' => $userID,
                    ]);
                Mail::to($request->input('email'))->send(new RegistrationMail($userID));

                return redirect('/auth/login')->withErrors(
                    ['msg' => 'Registration completed successfully. Kindly Check your email for further instructions']
                );

            } else {
                return redirect('/auth/login')->with('message', 'An account with that email already exists. Please login to proceed.');
            }
        } elseif ($user_type == 'customer') {

            if (!$existinguser) {
                // Create and save the new user
                $user = new User();
                $user->email = $request->input('email');
                $user->username = $request->input('username');
                $user->role = 'Customer';
                $password = $request->input('username') . '_smart_farmer_user';
                $user->password = Hash::make($password);
                $user->save();

                $userID = DB::getPdo()->lastInsertId();
                DB::table('password_resets')
                    ->insert([
                        'token' => str::random(60),
                        'user_id' => $userID,
                    ]);
                Mail::to($request->input('email'))->send(new RegistrationMail($userID));

                return redirect('/auth/login')->withErrors(
                    ['msg' => 'Registration completed successfully. Kindly Check your email for further instructions']
                );

            } else {
                return redirect('/auth/login')->with('message', 'An account with that email already exists. Please login to proceed.');

            }

        } else {
            abort(404);
        }
    }

    //3. reset passwords
    //the bellow method is to send an email for when the user request a password reset action
    public function sendPasswordRequestMail(Request $request)
    {
        $userInfo = User::all()->where('email', '=', $request->input('email'))->first();
        $user_id = $userInfo->id;

        DB::table('password_resets')
            ->insert([
                'token' => str::random(60),
                'user_id' => $userInfo->id,
            ]);
        Mail::to($request->input('email'))->send(new ResetRequestMail($user_id));
        return redirect('/auth/login');
    }

    //below method is to save passwords. this is universal
    public function passwordResetAction(Request $request)
    {
        $new_password = Hash::make($request->input('new_password'));
        $token_info = PasswordReset::all()->where('token','=',$request->input('token'))->first();
        $user_update = User::all()->where('id', '=', $token_info->user_id)->first();
        DB::table('users')->where('id', $user_update->id)->update(['account_status' => 'activated']);

        $user_update->password = $new_password;
        $user_update->email_verified_at = Carbon::now();
        $user_update->update();
        return redirect('/auth/login')->withErrors(['msg' => 'Password Reset Successfully. Your Account has been activated']);
    }

    //4. logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function validatelogin(Request $request)
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
        $verifieduser = PasswordReset::where('token', $token)->first();
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

}
