<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Views
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => ['required', 'string'],
                'password' => ['required'],
            ],
            [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.required' => 'Mật khẩu không được để trống.',
            ]
        );

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Checks status
            if (Auth::user()->status !== 1) {
                Auth::logout();
                return back()->withErrors(['username' => 'Tài khoản của bạn đã bị khóa.']);
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('username');
    }

    // Handle Register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $user = User::create([
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 1,
            'role' => \App\Constants\UserRole::CLIENT->value,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
