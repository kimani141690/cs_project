<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FarmerController extends Controller
{
    //
    public function showindex(){

        return view('farmer.index');

    }
}
