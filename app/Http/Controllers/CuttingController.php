<?php

namespace App\Http\Controllers;

use App\Imports\BTPImport;
use App\Imports\BTPLineImport;
use App\Models\BTP;
use App\Models\BTPDay;
use Illuminate\Http\Request;
use App\Models\Plan;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Exports\BTPExport;
use App\Exports\BTPDayExport;

class CuttingController extends Controller
{

    public function dashboard()
    {
        $plans = Plan::where('daxong', 0)
            ->where('daraichuyen', 1)
            ->orderBy('chuyen')
            ->get();

        return view("cutting.dashboard", compact("plans"));
    }

    public function editBtp(Plan $plan)
    {
        // if (before8h()) {
        //     return redirect()->back()->with('danger', "Chưa đến thời gian truy cập");
        // }
        // $kcs = $plan->kcs->where("ngaytao", date("Y-m-d"))->first();
        // if (!$kcs) {
        //     return redirect()->back()->with('danger', 'Vui lòng thử lại sau khi KCS nhập chỉ tiêu ngày');
        // }
        $btp = BTP::where('plan_id', $plan->id)->get();
        return view('cutting.edit-btp', compact('plan', 'btp'));
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

    public function addBtpWithPlan(Request $request)
    {
        BTP::create($request->all());
        return redirect()->back()->with('success', 'Tạo thành công.');

        // $exitsBtp = BTP::where('plan_id', $request->plan_id)
        //     ->where('size', $request->size)
        //     ->where('color', $request->color)
        //     ->first();
        // if ($exitsBtp) {
        //     return redirect()->back()->with('danger', 'Kế hoạch đã tồn tại.');
        // } else {
        //     BTP::create($request->all());
        //     return redirect()->back()->with('success', 'Tạo thành công.');
        // }
    }

    public function btpDelete(BTP $btp)
    {
        $btp->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }

    public function editBtpWithDay(BTP $btp)
    {

        $btpDay = BTPDay::where('ngay', date("Y-m-d"))
            ->where('btp_id', $btp->id)
            ->first();
        return view('cutting.edit-btp-day', compact('btp', 'btpDay'));
    }
    public function updateBtpWithDay(BTP $btp, Request $request)
    {
        if ($request->btp_day_id) {
            BTPDay::where("id", $request->btp_day_id)->update([
                "slcat" => $request->slcat,
                "slcap" => $request->slcap,
            ]);
            return redirect()->route('cutting.editBtp', $btp->plan_id)->with('success', "Cập nhật thành công.");
        } else {
            BTPDay::create($request->all());
            return redirect()->route('cutting.editBtp', $btp->plan_id)->with('success', "Cập nhật thành công.");
        }
    }

    public function btpUpload(Request $request)
    {
        try {
            Excel::import(new BTPImport($request->plan_id), $request->file);
            return redirect()->back()->with('success', "Tải lên thành công");
        } catch (ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->withFailures($failures);
        }
    }
    public function btpUploadLine(Request $request)
    {
        try {
            Excel::import(new BTPLineImport(), $request->file);
            return redirect()->back()->with('success', "Tải lên thành công");
        } catch (ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->withFailures($failures);
        }
    }

    public function btpEditPlan(BTP $btp)
    {
        return view("cutting.edit-btp-plan", compact("btp"));
    }
    public function btpEditPlanUpdate(BTP $btp, Request $request)
    {
        $btp->update($request->all());
        return redirect()->route("cutting.editBtp", $btp->plan->id);
    }

    public function detailBtp(BTP $btp)
    {
        $btpsDay = BTPDay::where("btp_id", $btp->id)->get();
        return view("cutting.detail-btp", compact("btp", "btpsDay"));
    }

    public function exportFileBtp(Plan $plan)
    {
        return Excel::download(new BTPExport($plan), "to-" . $plan->chuyen  . date("-d_m_Y")  . ".xlsx");
    }
    public function exportFileBtpDayWithDate()
    {
        return Excel::download(new BTPDayExport(),  "Bao-cao-btp-" . date("d-m-Y") . ".xlsx");
    }

    public function btpDetailDelete(BTPDay $btpDay)
    {
        $btpDay->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }
}
