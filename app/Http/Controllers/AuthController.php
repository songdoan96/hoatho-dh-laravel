<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('produce.dashboard');;
        }
        return view("login");
    }

    public function store(Request $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            if ($request->username === "maymau") {
                return redirect()->route('simple.dashboard')->with('success', 'Đăng nhập thành công');
            }
            if ($request->username === "noibo") {
                return redirect()->route('internal.document')->with('success', 'Đăng nhập thành công');
            }
            if ($request->username === "phulieu") {
                return redirect()->route('accessory.dashboard')->with('success', 'Đăng nhập thành công');
            }
            return redirect()->route('produce.dashboard')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('danger', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
}
