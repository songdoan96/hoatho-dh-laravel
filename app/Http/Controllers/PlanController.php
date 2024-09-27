<?php

namespace App\Http\Controllers;

use App\Exports\PlansExport;
use App\Models\Factory;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PlanController extends Controller
{
    public function dashboard()
    {
        $factories = Factory::all();
        $plans = Plan::where('daxong', 0)
            ->orderBy('daraichuyen', 'ASC')
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

    public function editLogo(Plan $plan)
    {
        $files = Storage::files('public/images/logo');
        return view('plan.update-logo', compact('plan', 'files'));
    }
    public function storeLogo(Plan $plan, Request $request)
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('images/logo', 'public');
            $plan->logo = $path;
            $plan->save();
            return redirect()->route('kcs.line', $plan->chuyen)->with('success', 'Thêm logo thành công');
        }
        if ($request->newImage) {
            $plan->logo = $request->newImage;
            $plan->save();
            return redirect()->route('kcs.line', $plan->chuyen)->with('success', 'Thêm logo thành công');
        }
    }

    public function download($date)
    {
        return Excel::download(new PlansExport($date), "baocao-" . date("d-m-Y", strtotime($date)) . ".xlsx");
    }


    public function editPlan(Plan $plan)
    {

        return view('plan.edit', compact('plan'));
    }

    public function editPlanUpdate(Plan $plan, Request $request)
    {
        if ($request->nhaphoanthanhthem) {
            $kcs = $plan->kcs->where("ngaytao", date("Y-m-d"))->first();
            if (!$kcs) {
                return redirect()->back()->with('danger', 'Vui lòng thử lại sau khi KCS nhập chỉ tiêu ngày');
            }
            $plan->nhaphoanthanh += $request->nhaphoanthanhthem;
            $plan->save();
            $kcs->nhaphoanthanh += $request->nhaphoanthanhthem;
            $kcs->save();
        } else {
            if ($request->tacnghiepmoi) {
                $plan->sltacnghiep += $request->tacnghiepmoi;
            }
            if ($request->mucvon) {
                $plan->mucvon = (float)$request->mucvon;
            }
            $plan->save();
        }

        return redirect()->route('produce.dashboard')->with('success', 'Cập nhật thành công');
    }
}
