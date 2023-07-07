<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    //
    public function showindex(){

        return view('customer.index');

    }
     public function cust_details(Request $request){

     }
}
