<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    //
    public function showindex(){

        if (request()->route()->named('farmer_details')) {
            return  view('farmer.farmer_details');
        }else {
            return view('farmer.index');
        }

    }

    public function farmers_details(Request $request)
    {

        // Create and save the new user
        $farmer = new Farmer();
        $farmer->contact = $request->input('contact');
        $farmer->location = $request->input('location');
        $farmer->address = $request->input('address');
        // Handle profile photo upload
        $profilePhotoPath ='';
        if ($request->hasFile('profile_photo')) {

            $profilePhotoPath = $request->getSchemeAndHttpHost() . '/assets/profiles/' . time() . '.' .$request->profile_photo->extension();
            $request->profile_photo->move(public_path('/assets/profiles/'),$profilePhotoPath);

        }
        $farmer->profile = $profilePhotoPath;

        $farmer->save();

        $farmer_id = DB::getPdo()->lastInsertId();

        DB::table('users')
            ->where('id', $request->input('user_id'))
            ->update(['farmers_id' => $farmer_id]);

        return view('auth.login')->with('message','You can know proceed to login');
    }

}
