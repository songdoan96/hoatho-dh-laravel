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
        // if (before8h()) {
        //     return redirect()->back()->with('danger', "Chưa đến thời gian truy cập");
        // }
        $kcs = $plan->kcs->where("ngaytao", date("Y-m-d"))->first();
        if (!$kcs) {
            return redirect()->back()->with('danger', 'Vui lòng thử lại sau khi KCS nhập chỉ tiêu ngày');
        }
        return view('produce.edit-btp', compact('plan'));
    }

    public function editBtpUpdate(Plan $plan, Request $request)
    {
        $kcs = $plan->kcs->where("ngaytao", date("Y-m-d"))->first();
        if (!$kcs) {
            return redirect()->back()->with('danger', 'Vui lòng thử lại sau khi KCS nhập chỉ tiêu ngày');
        }
        $btpNew = $plan->btpcap + $request->btpNew;
        $plan->btpcap = $btpNew;
        $kcs->btpcap = $btpNew;
        $plan->save();
        $kcs->save();
        return redirect()->route('produce.dashboard')->with('success', 'Cập nhật thành công');
    }


    public function supplementWarehouse(Plan $plan)
    {
        return view('produce.supplement-warehouse', compact('plan'));
    }
    public function supplementWarehouseUpdate(Plan $plan, Request $request)
    {
        if ($request->nhaphoanthanhthem) {
            $plan->nhaphoanthanh += $request->nhaphoanthanhthem;
            $plan->save();
        }

        return redirect()->route('produce.finish')->with('success', 'Cập nhật thành công');
    }
}
