<?php

namespace App\Http\Controllers;

use App\Models\Simple;
use Illuminate\Http\Request;

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
        return redirect()->route('simple.dashboard');
    }
    public function edit(Simple $simple)
    {
        return view("simple.edit", compact("simple"));
    }
    public function update(Request $request, $id)
    {
        if ($request->action === "simple-new") {
            Simple::create($request->all());
        }
        if ($request->action === "simple-edit") {

            Simple::findOrFail($id)->update($request->all());
        }
        return redirect()->route("simple.dashboard");
    }
    public function destroy(Simple $simple)
    {
        $simple->delete();
        return redirect()->route("simple.dashboard");
    }
}
