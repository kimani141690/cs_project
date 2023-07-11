<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    public function showindex()
    {
        if (request()->route()->named('customer_details')) {
            return  view('customer.customer_details');
        }else {
            return view('customer.index');
        }
    }
   public function cust_details(Request $request)
   {

       // Create and save the new user
       $customer = new Customer();
       $customer->contact = $request->input('contact');
       $customer->location = $request->input('location');
       $customer->home_address = $request->input('homeadress');
       // Handle profile photo upload
       $profilePhotoPath ='';
       if ($request->hasFile('profile_photo')) {

           $profilePhotoPath = $request->getSchemeAndHttpHost() . '/assets/profiles/' . time() . '.' .$request->profile_photo->extension();
           $request->profile_photo->move(public_path('/assets/profiles/'),$profilePhotoPath);

       }
       $customer->profile = $profilePhotoPath;

       $customer->save();

       $customer_id = DB::getPdo()->lastInsertId();

       DB::table('users')
           ->where('id', $request->input('user_id'))
           ->update(['customers_id' => $customer_id]);

       return redirect('login')->with('message','You can know proceed to login');
   }}
