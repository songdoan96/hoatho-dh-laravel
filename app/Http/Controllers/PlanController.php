<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function dashboard()
    {
        $factories = Factory::all();
        $plans = Plan::where('daxong', 0)->orderBy('created_at', 'DESC')->get();
        return view('plan.dashboard', compact('factories', 'plans'));
    }
    public function store(Request $request)
    {
        Plan::create($request->all());
        return redirect()->route('plan.dashboard');
    }
    public function planUp(Plan $plan)
    {
        // $chuyen = $plan->chuyen;
        // $countChuyen = Plan::where('chuyen', $chuyen)->where('daxong', 0)->get();
        // if (count($countChuyen) > 1) {
        //     return redirect()->back()->with('toast', $chuyen . ' còn đơn hàng chưa hoàn thành');
        // }
        $plan->daraichuyen = true;
        $plan->ngayrai = date('Y-m-d');
        $plan->save();
        return redirect()->route('plan.dashboard');
    }
}
