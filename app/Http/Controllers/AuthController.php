<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->username ?? "/");
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
            return redirect(Auth::user()->username ?? "/");
        } else {
            return redirect()->back()->with('status', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
}
