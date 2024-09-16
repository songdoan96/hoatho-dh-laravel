<?php

namespace App\Http\Controllers;

use App\Models\KCS;
use App\Models\Plan;
use App\Models\Simple;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show(?string $type = "produce")
    {
        if ($type === "produce") {
            $plans = Plan::where('daxong', 0)
                ->where('daraichuyen', 1)
                ->orderBy('chuyen')
                ->get();
            $plansWaiting = Plan::where('daxong', 0)
                ->where('daraichuyen', 0)
                ->orderBy('chuyen')
                ->get();
            return view('show', compact('type', 'plans', 'plansWaiting'));
        } elseif ($type === "kcs") {
            $kcsData = KCS::where('ngaytao', date('Y-m-d'))->with("plans")->get()->sortBy('plans.chuyen');
            return view("show", compact('type', 'kcsData'));
        } else {
            $simples = Simple::orderBy('created_at', 'desc')->limit(30)->get();
            return view("show", compact('type', 'simples'));
        }
    }
}
