<?php

namespace App\Http\Controllers;

use App\Models\Finished;
use Illuminate\Http\Request;

class FinishedController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->mahang) {
            $finishes = Finished::where('daxuat', 0)->where("mahang", $request->mahang)->get();
        }
        if ($request->po) {
            $finishes = Finished::where('daxuat', 0)->where("po", 'LIKE', "%$request->po%")->get();
        } else {
            $finishes = Finished::where('daxuat', 0)->get();
        }

        return view('finished.dashboard', compact('finishes'));
    }

    /**
     * Display a listing of the resource.
     */
    public function tv()
    {
        // $finishes=Finished::where('daxuat', 0)->get();  
        return view("finished.tv");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function position($position)
    {
        $finishes = Finished::where('daxuat', 0)
            ->where('vitri', $position)->get();
        return view("finished.position", compact("position", "finishes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkExist = Finished::where('mahang', $request->mahang)
            ->where('po', $request->po)
            ->where('mau', $request->mau)
            ->where('size', $request->size)
            ->where('slkh', $request->slkh)
            ->first();
        if ($checkExist) {
            return redirect()->back()->with('danger', "Mã hàng đã tồn tại.");
        }
        Finished::create($request->all());
        return redirect()->back()->with('success', "Thêm mới thành công.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finished $finished)
    {
        return view("finished.edit", compact("finished"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finished $finished)
    {
        $finished->update($request->all());
        return redirect()->route('finished.dashboard')->with('success', "Chỉnh sửa thành công.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finished $finished)
    {
        $finished->delete();
        return redirect()->back()->with('success', "Xóa thành công.");
    }
}
