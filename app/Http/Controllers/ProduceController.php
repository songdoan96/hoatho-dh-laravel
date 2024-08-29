<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class ProduceController extends Controller
{
    public function dashboard()
    {
        $plans = Plan::where('daxong', 0)->where('daraichuyen', 1)->get();
        return view('produce.dashboard', compact('plans'));
    }
}
