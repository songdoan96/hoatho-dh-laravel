<?php

namespace App\Http\Controllers;

use App\Models\KCS;
use App\Models\Plan;
use Illuminate\Http\Request;

class KCSController extends Controller
{


    public function dashboard(Request $request)
    {
        if ($request->ngay) {
            $kcsData = KCS::where('ngaytao', $request->ngay)->orderBy('id', "DESC")->with("plans")->get();
        } else {
            $kcsData = KCS::where('ngaytao', date('Y-m-d'))->orderBy('id', "DESC")->with("plans")->get();
        }
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
            $kcs = KCS::create($request->all());
            return redirect()->route('kcs.edit', $kcs)->with('success', "Thêm chỉ tiêu thành công");
        }
    }

    public function passed(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
        }
        $plan = Plan::find($kcs->plan_id);
        $plan->thuchien += 1;
        if ($plan->thuchien > $plan->sltacnghiep) {
            return redirect()->back()->with('danger', "HẾT HÀNG - THÔNG BÁO KẾ HOẠCH LÊN ĐƠN HÀNG MỚI");
        }
        $plan->save();
        $kcs->sldat += 1;
        $kcs->save();
        return redirect()->back()->with('success', "+1 sản phẩm đạt");
    }

    public function failed(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
        }
        $kcs->slloi += 1;
        $kcs->save();
        return redirect()->back()->with('danger', "+1 sản phẩm lỗi");
    }

    public function updateErrorInfo(KCS $kcs, Request $request)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
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
        if ($plan) {
            $kcs = KCS::where('plan_id', $plan->id)->where('ngaytao', date("Y-m-d"))->first();
            if (isset($kcs)) {
                $tyledat = ($kcs->sldat / $kcs->chitieungay) * 100;
                $tyleloi = 0;
                if ($kcs->sldat != 0 || $kcs->slloi != 0) {
                    $tyleloi = ($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100;
                }
                $von = abs(($plan->btpcap - $plan->nhaphoanthanh) / $kcs->chitieungay);
                $errors = explode(",", $kcs->chitietloi);


                $totalHour = 8.5;
                $current_time = strtotime(date("Y-m-d H:i:s"));
                $morning_start = strtotime(date('Y-m-d 07:30:00'));
                $lunch_start = strtotime(date('Y-m-d 11:30:00'));
                $lunch_end = strtotime(date('Y-m-d 12:30:00'));
                $afternoon_start = strtotime(date('Y-m-d 17:00:00'));

                if ($current_time < $morning_start) {
                    $totalSecond = 0;
                } elseif ($current_time >= $morning_start && $current_time <= $lunch_start) {
                    $totalSecond = $current_time - $morning_start;
                } elseif ($current_time > $lunch_start && $current_time <= $lunch_end) {
                    $totalSecond = 4 * 60 * 60;
                } elseif ($current_time > $lunch_end && $current_time <= $afternoon_start) {
                    $totalSecond = $current_time - $morning_start - 3600;
                } elseif ($current_time > $afternoon_start) {
                    $totalSecond = 8.5 * 60 * 60;
                }
                $ndsx = $totalHour * 3600 / $kcs->chitieungay;
                $dmhientai = ceil($totalSecond / $ndsx);

                return view('kcs.line', compact('plan', 'kcs', 'von', 'tyledat', 'tyleloi', 'errors', 'dmhientai'));
            }
        }
        return view('kcs.line', compact('plan'));
    }
    public function editWorker(KCS $kcs)
    {

        return view('kcs.edit-worker', compact('kcs'));
    }
    public function updateWorker(KCS $kcs, Request $request)
    {
        $kcs->update($request->all());
        return redirect()->route('produce.dashboard')->with('success', "Cập nhật thành công");
    }
    public function editPassFail(KCS $kcs)
    {
        return view('kcs.edit-pass-fail', compact('kcs'));
    }
    public function updatePassFail(KCS $kcs, Request $request)
    {
        $kcs->update([
            "sldat" => $kcs->sldat + $request->sldat,
            "slloi" => $kcs->slloi + $request->slloi,
        ]);
        $kcs->plans->update([
            "thuchien" => $kcs->plans->thuchien + $request->sldat
        ]);
        return redirect()->route('kcs.dashboard')->with('success', "Cập nhật thành công");
    }
}
