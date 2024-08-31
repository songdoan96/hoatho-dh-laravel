<?php

namespace App\Http\Controllers;

use App\Models\KCS;
use App\Models\Plan;
use Illuminate\Http\Request;

class KCSController extends Controller
{


    public function dashboard()
    {
        $kcsData = KCS::where('ngaytao', date('Y-m-d'))->orderBy('id', "DESC")->with("plans")->get();
        return view("kcs.dashboard", compact('kcsData'));
    }

    public function edit(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
        }
        return view("kcs.edit", compact('kcs'));
    }

    public function add(Request $request)
    {
        if (after8h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
        }
        if ($request->xn) {
            $xn = "XN" . $request->xn;
            $plans = Plan::where("daxong", 0)
                ->where("chuyen", "LIKE", $xn . "%")
                ->where("daraichuyen", 1)->get();
            if (count($plans)) {
                return view("kcs.add", compact('plans', 'xn'));
            }
        }
        return redirect()->back()->with('danger', "Chưa có thông tin sản xuất");
    }

    public function store(Request $request)
    {
        $hasPlan = KCS::where("ngaytao", date("Y-m-d"))->where('plan_id', $request->plan_id)->first();
        if ($hasPlan) {
            return redirect()->route('kcs.dashboard')->with('danger', "Thêm không thành công, do đã thêm chỉ tiêu cho hôm nay");
        } else {
            KCS::create($request->all());
            return redirect()->route('kcs.dashboard')->with('success', "Thêm chỉ tiêu thành công");
        }
    }

    public function passed(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian quy định");
        }
        $plan = Plan::find($kcs->plan_id);
        $plan->thuchien += 1;
        $plan->save();
        $kcs->sldat += 1;
        $kcs->save();
        return redirect()->back()->with('success', "+1 sản phẩm đạt");
    }

    public function failed(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian quy định");
        }
        $kcs->slloi += 1;
        $kcs->save();
        return redirect()->back()->with('danger', "+1 sản phẩm lỗi");
    }

    public function updateErrorInfo(KCS $kcs, Request $request)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian quy định");
        }
        $kcs->chitietloi = $request->chitietloi;
        $kcs->save();
        return redirect()->back()->with('success', "Cập nhật lỗi thành công");
    }


    public function line($line)
    {
        $plan = Plan::where('chuyen', $line)
            ->where('daraichuyen', 1)
            ->where('daxong', 0)
            ->orderBy('created_at', 'desc')
            ->first();
        $kcs= KCS::where('plan_id', $plan->id)->first();
        return view('kcs.line', compact('plan','kcs'));
    }
}
