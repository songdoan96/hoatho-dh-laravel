<?php

namespace App\Http\Controllers;

use App\Models\Welcome;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function welcome()
    {
        $images = Welcome::all();
        return view('admin.welcome', compact('images'));
    }
    public function uploadStore(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            Welcome::create(['path' => $path]);
        }

        return redirect()->route('admin.welcome');
    }
    public function imageChange(Welcome $welcome)
    {
        $welcome->active = !$welcome->active;
        $welcome->save();
        return redirect()->route('admin.welcome');
    }
}
