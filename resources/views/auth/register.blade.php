@extends('layouts.app')

@section('title', 'Đăng ký thành viên - Shop Acc FC Online')
@section('description', 'Tạo tài khoản mới tại Shop Acc FC Online để nhận nhiều ưu đãi và mua bán tài khoản dễ dàng.')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-900">Đăng ký thành viên</h1>
            <p class="mt-2 text-sm text-gray-600">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">
                    Đăng nhập ngay
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="username" class="sr-only">Tên đăng nhập</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">person</span>
                        </span>
                        <input id="username" name="username" type="text" autocomplete="username" required
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Tên đăng nhập" value="{{ old('username') }}">
                    </div>
                    @error('username')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="sr-only">Mật khẩu</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">lock</span>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Mật khẩu (tối thiểu 8 ký tự)">
                    </div>
                    @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="sr-only">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">lock_clock</span>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Nhập lại mật khẩu">
                    </div>
                </div>

                <div>
                    <label for="referrer_id" class="sr-only">Mã người giới thiệu (tùy chọn)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">group_add</span>
                        </span>
                        <input id="referrer_id" name="referrer_id" type="text"
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="ID người giới thiệu (tùy chọn)"
                            value="{{ request('ref') ?? old('referrer_id') }}">
                    </div>
                    @error('referrer_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Nếu bạn được giới thiệu, nhập ID người giới thiệu để nhận ưu đãi</p>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors shadow-lg shadow-primary/30">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <span class="material-icons text-white/50 group-hover:text-white transition-colors">person_add</span>
                    </span>
                    ĐĂNG KÝ TÀI KHOẢN
                </button>
            </div>

            <p class="text-xs text-center text-gray-500 mt-4">
                Bằng việc đăng ký, bạn đồng ý với <a href="#" class="text-primary hover:underline">Điều khoản dịch vụ</a> và <a href="#" class="text-primary hover:underline">Chính sách bảo mật</a> của chúng tôi.
            </p>
        </form>
    </div>
</div>
@endsection