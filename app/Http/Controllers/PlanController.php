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
        $plans = Plan::where('daxong', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('plan.dashboard', compact('factories', 'plans'));
    }

    public function store(Request $request)
    {
        $chuyen = $request->chuyen;
        $countChuyen = Plan::where('chuyen', $chuyen)
            ->where('daxong', 0)
            ->where('daraichuyen', 0)
            ->get();

        if (count($countChuyen) >= 1) {
            return redirect()->back()->with('danger', $chuyen . ' còn đơn hàng chưa rải chuyền');
        }
        Plan::create($request->all());
        return redirect()->route('plan.dashboard')->with('success', 'Đã thêm đơn hàng chờ sản xuất');
    }

    public function planDelete(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plan.dashboard')->with('success',  'Xóa thành công');
    }

    public function planUp(Plan $plan)
    {
        $chuyen = $plan->chuyen;
        $countChuyen = Plan::where('chuyen', $chuyen)
            ->where('daxong', 0)
            ->where('daraichuyen', 1)->get();
        if (count($countChuyen) >= 1) {
            return redirect()->back()->with('danger', $chuyen . ' còn đơn hàng chưa kết thúc');
        }
        $plan->daraichuyen = true;
        $plan->ngayrai = date('Y-m-d');
        $plan->save();
        return redirect()->route('plan.dashboard')->with('success', 'Đơn hàng đã được rải chuyền');
    }
    public function planDone(Plan $plan)
    {
        $plan->daxong = true;
        $plan->ngayxong = date('Y-m-d H:i:s');
        $plan->save();
        return redirect()->back()->with('success', 'Đơn hàng đã kết thúc');
    }
}
