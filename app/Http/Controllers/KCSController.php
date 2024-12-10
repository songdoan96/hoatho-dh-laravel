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
            $kcsData = KCS::where('ngaytao', $request->ngay)->with("plans")->get()->sortBy('plans.chuyen');
        } else {
            $kcsData = KCS::where('ngaytao', date('Y-m-d'))->with("plans")->get()->sortBy('plans.chuyen');
        }
        return view("kcs.dashboard", compact('kcsData'));
    }

    public function edit(KCS $kcs)
    {
        if (after17h()) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đã quá thời gian truy cập");
        }
        if ($kcs->plans->daxong == 1) {
            return redirect()->route('kcs.dashboard')->with('danger', "Đơn hàng đã kết thúc vui, vui lòng chọn đơn hàng mới");
        };
        return view("kcs.edit", compact('kcs'));
    }

    public function add(Request $request)
    {
        // if ($request->xn) {
        //     $xn = "XN" . $request->xn;
        //     $plans = Plan::where("daxong", 0)
        //         ->where("chuyen", "LIKE", $xn . "%")
        //         ->where("daraichuyen", 1)
        //         ->orderBy("chuyen")
        //         ->get();
        //     if (count($plans)) {
        //         return view("kcs.add", compact('plans', 'xn'));
        //     }
        // }
        // return redirect()->back()->with('danger', "Chưa có thông tin sản xuất");



        $plans = Plan::where("daxong", 0)
            ->where("daraichuyen", 1)
            ->orderBy("chuyen")
            ->get();
        if (count($plans)) {
            return view("kcs.add", compact('plans'));
        }
        return redirect()->back()->with('danger', "Chưa có thông tin sản xuất");
    }

    public function store(Request $request)
    {
        $hasPlan = KCS::where("ngaytao", date("Y-m-d"))
            ->where('plan_id', $request->plan_id)->first();
        if ($hasPlan) {
            return redirect()->route('kcs.dashboard')->with('danger', "Thêm không thành công, do đã thêm chỉ tiêu cho hôm nay");
        } else {
            $kcsBefore = KCS::where('plan_id', $request->plan_id)->orderBy("ngaytao", "DESC")->first();
            $kcs = KCS::create([
                ...$request->all(),
                "thuchien" => $kcsBefore->thuchien ?? 0,
                "nhaphoanthanh" => $kcsBefore->nhaphoanthanh ?? 0,
                "btpcap" => $kcsBefore->btpcap ?? 0,
            ]);
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
        $kcs->thuchien += 1;
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
        if (lunchTime()) {
            return redirect()->route('freeTime', compact('line'));
        }

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
                if ($plan->chuyen == 11 || $plan->chuyen == 15) {
                    $von = abs(($plan->btpcap - $plan->nhaphoanthanh) / $kcs->chitieungay);
                } else {
                    $von = abs(($plan->btp_day->sum('slcap') - $plan->nhaphoanthanh) / $kcs->chitieungay);
                }
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
    public function editWorker()
    {
        $kcsAll = KCS::where("ngaytao", date('Y-m-d'))->with('plans')->get()->sortBy('plans.chuyen');
        return view('kcs.edit-worker', compact('kcsAll'));
    }
    public function updateWorker(KCS $kcs, Request $request)
    {
        $kcs->update($request->all());
        return redirect()->back()->with('success', "Cập nhật thành công");
    }
    public function editPassFail(KCS $kcs)
    {
        return view('kcs.edit-pass-fail', compact('kcs'));
    }
    public function updatePassFail(KCS $kcs, Request $request)
    {
        $thuchien = $kcs->thuchien + $request->sldat;
        $kcs->update([
            "sldat" => $kcs->sldat + $request->sldat,
            "slloi" => $kcs->slloi + $request->slloi,
            "thuchien" => $thuchien
        ]);
        $kcs->plans->update([
            "thuchien" => $thuchien
        ]);
        return redirect()->route('kcs.dashboard')->with('success', "Cập nhật thành công");
    }

    public function editYesterday(KCS $kcs)
    {
        $kcsBefore = KCS::where('plan_id', $kcs->plan_id)->orderBy("ngaytao", "DESC")->limit(2)->get();
        $kcsBefore = $kcsBefore[1];
        return view("kcs.edit-yesterday", compact("kcs", "kcsBefore"));
    }
    public function editYesterdayUpdate(KCS $kcs, Request $request)
    {
        $thuchien = $request->qty_before + $kcs->sldat;
        $plan = Plan::find($kcs->plan_id);
        if ($thuchien > $plan->sltacnghiep) {
            return redirect()->back()->with("danger", "Không thành công do vượt quá kế hoạch");
        }
        $plan->thuchien = $thuchien;
        $plan->save();
        $kcsBefore = KCS::find($request->id_before);
        $kcsBefore->thuchien = $request->qty_before;
        $kcsBefore->save();
        $kcs->thuchien = $thuchien;
        $kcs->save();


        return redirect()->route("kcs.dashboard")->with("success", "Cập nhật thành công.");
    }
}
