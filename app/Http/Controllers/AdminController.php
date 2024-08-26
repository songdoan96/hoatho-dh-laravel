<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function imageDelete(Welcome $welcome)
    {
        Storage::disk('public')->delete($welcome->path);
        $welcome->delete();
        return redirect()->route('admin.welcome');
    }

    public function schedule()
    {
        $schedules = Schedule::orderBy('id', 'desc')->get();
        return view('admin.schedule', compact('schedules'));
    }
    public function scheduleStore(Request $request)
    {
        Schedule::create($request->all());
        return redirect()->route('admin.schedule');
    }
    public function scheduleDone(Schedule $schedule)
    {
        $schedule->done = !$schedule->done;
        $schedule->save();
        return redirect()->route('admin.schedule');
    }
    public function scheduleDelete(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedule');
    }
}
