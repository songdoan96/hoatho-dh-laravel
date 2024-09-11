<?php

namespace App\Http\Controllers;

use App\Models\KCS;
use App\Models\Plan;
use Illuminate\Http\Request;

class ProduceController extends Controller
{
    public function dashboard()
    {
        $plans = Plan::where('daxong', 0)
            ->where('daraichuyen', 1)
            ->orderBy('chuyen')
            ->get();
        $plansWaiting = Plan::where('daxong', 0)
            ->where('daraichuyen', 0)
            ->orderBy('chuyen')
            ->get();
        return view('produce.dashboard', compact('plans', 'plansWaiting'));
    }

    public function finish()
    {
        $plans = Plan::where('daxong', 1)
            ->orderBy('ngayxong', 'DESC')
            ->get();
        return view('produce.finish', compact('plans'));
    }

    public function editBtp(Plan $plan)
    {
        if (before8h()) {
            return redirect()->back()->with('danger', "Chưa đến thời gian truy cập");
        }
        return view('produce.edit-btp', compact('plan'));
    }

    public function editBtpUpdate(Plan $plan, Request $request)
    {
        if (before8h()) {
            return redirect()->back()->with('danger', "Chưa đến thời gian truy cập");
        }
        $btpNew = $plan->btpcap + $request->btpNew;
        $kcs = KCS::where('plan_id', $plan->id)
            ->where("ngaytao", date("Y-m-d"))->first();
        if ($kcs) {
            $plan->btpcap = $btpNew;
            $kcs->btpcap = $btpNew;
            $plan->save();
            $kcs->save();
            return redirect()->route('produce.dashboard')->with('success', 'Cập nhật thành công');
        }
        return redirect()->back()->with('danger', "Chưa đến thời gian truy cập");
    }


    public function supplementWarehouse(Plan $plan)
    {
        return view('produce.supplement-warehouse', compact('plan'));
    }
    public function supplementWarehouseUpdate(Plan $plan, Request $request)
    {
        if ($request->nhaphoanthanh) {
            $plan->nhaphoanthanh = $request->nhaphoanthanh;
            $plan->save();
        }

        return redirect()->route('produce.finish')->with('success', 'Cập nhật thành công');
    }
}
