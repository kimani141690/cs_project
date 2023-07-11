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

            if ($user->customers_id === null || $user->farmers_id === null) {
                if ($user->role == 'Customer') {
                    return view('/customer/customer_details', ['userId' => $user->id]);

                } elseif ($user->role == 'Farmer') {
                    return view('/farmer/farmer_details', ['userId' => $user->id]);

                }
            } else {


                if ($user->role == 'Customer') {
                    $request->session()->put('user_id', $user->id);
                    $request->session()->put('user_name', $user->name);
                    $request->session()->put('customers_is', $user->customer_id);


                    return redirect()->intended('/customer/index');

                } elseif ($user->role == 'Farmer') {
                    $request->session()->put('user_id', $user->id);
                    $request->session()->put('user_name', $user->name);
                    $request->session()->put('farmers_id', $user->farmer_id);
                    $profile = DB::table('farmers')->select('profile')->where('id', $user->farmer_id)->get();
                     if ($profile->isNotEmpty()) {
                        $request->session()->put('profile', $profile[0]->profile);
                    }

                    return redirect()->intended('/farmer/index');
                }

                // Customize your logic here, such as redirecting to a dashboard page
                return redirect()->intended('/');
            }


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
        $token_info = PasswordReset::all()->where('token', '=', $request->input('token'))->first();
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

}
