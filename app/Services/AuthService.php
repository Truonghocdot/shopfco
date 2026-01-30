<?php

namespace App\Services;

use App\Constants\UserRole;
use App\Models\User;
use App\Types\ServiceResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function handleLoginUser(array $credentials): ServiceResult
    {
        try {
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                throw new \Exception('Tài khoản không tồn tại');
            }
            if (!Hash::check($credentials['password'], $user->password)) {
                throw new \Exception('Mật khẩu không chính xác');
            }
            if ($user->role != UserRole::ADMIN->value) {
                throw new \Exception('Bạn không có quyền truy cập');
            }
            Auth::login($user);
            return ServiceResult::success('Đăng nhập thành công');
        } catch (\Exception $e) {
            return ServiceResult::error($e->getMessage());
        }
    }
}
