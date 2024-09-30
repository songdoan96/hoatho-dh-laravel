<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Imports\AccessoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class AccessoryController extends Controller
{
    public function dashboard()
    {
        $accessories = Accessory::orderBy("created_at", "DESC")->limit(50)->get();
        return view("accessory.dashboard", compact("accessories"));
    }
    public function show()
    {

        // $accessories = Accessory::orderBy("created_at", "DESC")->limit(50)->get();
        $accessories = Accessory::where("het", false)
            ->groupBy("day", "mahang")
            ->select("khachhang", "mahang", "day", "loai")
            ->get()
            ->toArray();
        $result = [];
        foreach ($accessories as $key => $accessory) {
            $result[] = $accessory;
            // if ($result["day"] == $accessory["day"]) {
            //     $result[] = $accessory;
            // } else {
            // }
        }
        print_r($result);
        return view("accessory.show", compact("accessories", "result"));
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
                "order_id" => $accessory->id,
                "het" => true
            ]);
        } else {
            Accessory::create([
                ...$request->all(),
                "order_id" => $accessory->id
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
        $accessories = Accessory::where("het", 0)
            ->where("order_id", null)
            ->where("day", $day)
            ->groupBy("loai", "mau", "size")
            ->get();
        return view("accessory.row", compact("accessories", "day"));
    }
    public function style($mahang)
    {
        $accessories = Accessory::where("het", false)
            ->where("mahang", $mahang)
            ->where("order_id", null)
            ->groupBy("loai", "mau", "size")
            ->get();
        return view("accessory.style", compact("accessories", "mahang"));
    }
    public function type(Accessory $accessory)
    {
        $accessories = Accessory::where("het", false)
            ->where("order_id", null)
            ->where("loai", $accessory->loai)
            ->where("mahang", $accessory->mahang)
            ->where("size", $accessory->size)
            ->where("mau", $accessory->mau)
            ->with("orders")
            ->get();
        return view("accessory.type", compact("accessories", "accessory"));
    }

    public function upload(Request $request)
    {
        Excel::import(new AccessoryImport, $request->file);
        return redirect()->route('accessory.dashboard')->with('success', "Tải lên thành công");
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
}
