<?php

namespace App\Http\Controllers;

use App\Models\Finished;
use Illuminate\Http\Request;

class FinishedController extends Controller
{
    public function dashboard()
    {
        $finishes = Finished::where('daxuat', 0)->get();
        return view('finished.dashboard', compact('finishes'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
