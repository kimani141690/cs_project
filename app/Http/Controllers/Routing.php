<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Routing extends Controller
{
    //
    public function showIndex()
    {
        return view('index');
    }
}
