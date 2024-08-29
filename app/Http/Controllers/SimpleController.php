<?php

namespace App\Http\Controllers;

use App\Models\Simple;
use Illuminate\Http\Request;

use App\Exports\SimplesExport;
use Maatwebsite\Excel\Facades\Excel;

class SimpleController extends Controller
{
    public function index()
    {
        $simples = Simple::orderBy('created_at', 'desc')->limit(30)->get();
        return view("simple.index", compact('simples'));
    }
    public function dashboard(Request $request)
    {

        $simples = $request->query("tuan") ? Simple::where("tuan", "LIKE", "%" . $request->query('tuan') . "%")->orderBy('created_at', 'desc')->limit(30)->get() : Simple::orderBy('created_at', 'desc')->limit(30)->get();
        return view("simple.dashboard", compact('simples'));
    }
    public function add()
    {
        return view("simple.add");
    }
    public function store(Request $request)
    {
        Simple::create($request->all());
        return redirect()->route('simple.dashboard')->with('toast', "Thêm mẫu thành công");
    }
    public function edit(Simple $simple)
    {
        return view("simple.edit", compact("simple"));
    }
    public function update(Request $request, $id)
    {
        if ($request->action === "simple-new") {
            $message = "Thêm mới thành công";
            Simple::create($request->all());
        }
        if ($request->action === "simple-edit") {
            $message = "Chỉnh sửa thành công";
            Simple::findOrFail($id)->update($request->all());
        }
        return redirect()->route("simple.dashboard")->with('toast', $message);
    }
    public function destroy(Simple $simple)
    {
        $simple->delete();
        return redirect()->route("simple.dashboard")->with('toast', "Đã xóa mẫu");;
    }
    public function download($tuan)
    {

        return $tuan === "all" ?  Excel::download(new SimplesExport(Simple::all()), 'maymau.xlsx') : Excel::download(new SimplesExport(Simple::where("tuan", "LIKE", "%" . $tuan . "%")->get()), 'maymau.xlsx');
    }
}
