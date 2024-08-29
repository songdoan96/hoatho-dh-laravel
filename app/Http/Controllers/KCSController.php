<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KCSController extends Controller
{
    public function dashboard()
    {
        return view("kcs.dashboard");
    }
}
