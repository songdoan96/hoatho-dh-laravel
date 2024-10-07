<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Imports\AccessoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Validators\ValidationException;

class AccessoryController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->search_value && $request->search_type == "type") {
            $accessories = Accessory::where("het", false)->where("loai", "like", "%$request->search_value%")
                ->get();
        } elseif ($request->search_value && $request->search_type == "mahang") {
            $accessories = Accessory::where("het", false)->where("mahang", "like", "%$request->search_value%")
                ->get();
        } else {

            $accessories = Accessory::orderBy("created_at", "DESC")->limit(100)->get();
        }
        return view("accessory.dashboard", compact("accessories"));
    }
    public function show()
    {

        // $accessories = Accessory::orderBy("created_at", "DESC")->limit(50)->get();
        $accessories = Accessory::where("het", false)
            ->groupBy("day", "mahang", "loai")
            ->select("khachhang", "mahang", "day", "loai")
            ->get()
            ->toArray();
        $containers = [];
        foreach ($accessories as $key => $value) {
            if (in_array($value["day"], array_keys($containers))) {
                $containers[$value["day"]] = [...$containers[$value["day"]], [$value["khachhang"], $value["mahang"], $value["loai"]]];
            } else {
                $containers[$value["day"]][] = [$value["khachhang"], $value["mahang"], $value["loai"]];
            }
        }
        $dayAccessories = [];
        foreach (array_merge(range('A', 'L'), ['TTH']) as $key => $value) {
            $i = Accessory::where("het", false)->whereNull("order_id")->where("day", $value)->select("day", "khachhang")->first();
            if ($i) {
                $dayAccessories[] = $i;
            }
        }
        // $countCustomers = [];
        // foreach ($dayAccessories as $k => $v) {
        //     if (in_array($v->khachhang, array_keys($countCustomers))) {
        //         $countCustomers[$v->khachhang] = $countCustomers[$v->khachhang] + 1;
        //     } else {
        //         $countCustomers[$v->khachhang] = 1;
        //     }
        // }
        $nAccessories = Accessory::where("het", false)
            ->groupBy("day", "khachhang")
            ->select("day", "khachhang", "mahang")
            ->orderBy("khachhang")->get();
        $newCount = [];
        foreach ($nAccessories as  $v1) {
            if (in_array($v1->khachhang, array_keys($newCount))) {
                $newCount[(string)$v1->khachhang] = $newCount[(string)$v1->khachhang] + 1;
            } else {
                $newCount[(string)$v1->khachhang] = 1;
            }
        }
        // $newCount["Trống"] = 13 - count(Accessory::where("het", false)
        //     ->groupBy("day")
        //     ->orderBy("day")->get());
        $countEmpty = 13 - count(Accessory::where("het", false)
            ->groupBy("day")
            ->orderBy("day")->get());

        return view("accessory.show", compact("accessories", "containers", "newCount", "countEmpty"));
    }
    public function add($id = null)
    {
        if ($id) {
            $accessory = Accessory::find($id);
            return view("accessory.add", compact('accessory'));
        }
        return view("accessory.add");
    }
    public function store(Request $request)
    {
        Accessory::create($request->all());
        return redirect()->route('accessory.dashboard')->with('success', "Thêm thành công");
    }

    public function order($order_id)
    {
        $accessory = Accessory::find($order_id);
        $totalOrders = $accessory->orders()->sum("soluong");
        if ($totalOrders == $accessory->soluong) {
            return redirect()->back()->with('danger', "Phụ liệu này đã hết");
        };
        return view("accessory.order", compact("accessory", "totalOrders"));
    }
    public function orderStore($id, Request $request)
    {
        $accessory = Accessory::find($id);
        $totalOrders = $accessory->orders()->sum("soluong");
        if ($accessory->soluong - $totalOrders == (float)$request->soluong) {
            $accessory->het = true;
            $accessory->save();
            Accessory::create([
                ...$request->all(),
                "order_id" => $id,
                "het" => true
            ]);
        } else {
            Accessory::create([
                ...$request->all(),
                "order_id" => $id
            ]);
        }

        return redirect()->route('accessory.dashboard')->with('success', "Xuất kho thành công");
    }

    public function delete(Accessory $accessory)
    {
        $accessory->delete();
        if ($accessory->order_id) {
            return redirect()->route('accessory.type', $accessory->order_id)->with("success", "Xóa thành công");
        } else {
            return redirect()->route('accessory.dashboard')->with("success", "Xóa thành công");
        }

        // $accessory = Accessory::find($order_id);
        // $accParent = Accessory::find($accessory->order_id);
        // if ($accParent) {
        //     $accParent->het = false;
        //     $accParent->save();
        // }
        // $accessory->delete();
        // return redirect()->back()->with("success", "Xóa thành công");
    }

    public function row($day)
    {
        $accessories = Accessory::where("het", false)
            ->where("order_id", null)
            ->where("day", $day)
            ->groupBy("mahang", "loai", "mau", "size")
            ->orderBy("loai")
            ->orderBy("size")
            ->orderBy("mau")
            ->get();
        return view("accessory.row", compact("accessories", "day"));
    }
    public function style(Accessory $accessory)
    {
        $accessories = Accessory::where("order_id", null)
            ->where("het", false)
            ->where("mahang", $accessory->mahang)
            ->groupBy("loai", "mau", "size")
            ->get();
        $mahang = $accessory->mahang;
        return view("accessory.style", compact("accessories", "mahang"));
    }
    public function type(Accessory $accessory)
    {

        $accessories = Accessory::where("het", false)
            ->whereNull("order_id")
            ->where("loai", $accessory->loai)
            ->where("khachhang", $accessory->khachhang)
            ->where("mahang", $accessory->mahang)
            ->where("size", $accessory->size)
            ->where("mau", $accessory->mau)
            ->with("orders")
            ->get();
        // if (!count($accessories)) {
        //     return redirect()->back()->with("danger", "Phụ liệu này đã hết");
        // }
        return view("accessory.type", compact("accessories", "accessory"));
    }

    public function upload(Request $request)
    {
        try {
            Excel::import(new AccessoryImport, $request->file);
            return redirect()->route('accessory.dashboard')->with('success', "Tải lên thành công");
        } catch (ValidationException $e) {
            $failures = $e->failures();

            return redirect()->back()->withFailures($failures);
        }
    }
    public function downloadFile()
    {
        return Response::download("phu-lieu.xlsx");
    }

    public function edit(Accessory $accessory)
    {
        // $accessory = Accessory::find($id);
        return view("accessory.edit", compact("accessory"));
    }
    public function update(Accessory $accessory, Request $request)
    {
        $accessory->update($request->all());
        return redirect()->route("accessory.type", $accessory->id)->with("success", "Cập nhật thành công.");
    }
    public function soldOut(Request $request, $mahang = null, Accessory $accessory = null)
    {
        if ($mahang && $accessory == null) {
            $accessories = Accessory::where("het", true)
                ->where("mahang", $mahang)
                ->whereNull("order_id")
                ->orderBy("mahang")
                ->orderBy("loai")
                ->orderBy("size")
                ->orderBy("mau")
                ->with("orders")
                ->get();
        } else if ($mahang && $accessory != null) {
            $accessories = Accessory::where("het", true)
                ->where("mahang", $mahang)
                ->where("loai", $accessory->loai)
                ->whereNull("order_id")
                ->orderBy("mahang")

                ->orderBy("loai")
                ->orderBy("size")
                ->orderBy("mau")
                ->with("orders")
                ->get();
        } else {
            $accessories = Accessory::where("het", true)
                ->whereNull("order_id")
                ->orderBy("mahang")
                ->orderBy("loai")
                ->orderBy("size")
                ->orderBy("mau")
                ->with("orders")
                ->get();
        }
        return view("accessory.sold-out", compact("accessories"));
    }
}
