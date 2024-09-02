<?php

namespace App\Http\Controllers;

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

    public function editWarehouse(Plan $plan)
    {

        return view('produce.editwarehouse', compact('plan'));
    }

    public function editWarehouseUpdate(Plan $plan, Request $request)
    {
        if ($request->tacnghiepmoi) {
            $plan->sltacnghiep += $request->tacnghiepmoi;
            $plan->save();
        }
        if ($request->nhaphoanthanh) {
            $plan->nhaphoanthanh = $request->nhaphoanthanh;
            $plan->save();
        }
        return redirect()->route('produce.finish')->with('success', 'Cập nhật thành công');
    }
}
