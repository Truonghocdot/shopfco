@extends('layouts.app')

@section('title', 'Đăng nhập - Shop Acc FC Online Uy Tín')
@section('description', 'Đăng nhập vào tài khoản Shop Acc FC Online để mua bán, nạp tiền và quản lý tài khoản của bạn.')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-900">Đăng nhập tài khoản</h1>
            <p class="mt-2 text-sm text-gray-600">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">
                    Đăng ký ngay
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
            <div class="border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <span class="material-icons text-red-500 text-sm">error</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="username" class="sr-only">Tên đăng nhập</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">person</span>
                        </span>
                        <input id="username" name="username" type="text" autocomplete="username" required
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Tên đăng nhập"
                            value="{{ old('username') }}">
                    </div>
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <span class="material-icons text-lg">lock</span>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-xl relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Mật khẩu">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-primary-dark">
                        Quên mật khẩu?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors shadow-lg shadow-primary/30">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <span class="material-icons text-white/50 group-hover:text-white transition-colors">login</span>
                    </span>
                    ĐĂNG NHẬP
                </button>
            </div>
        </form>
    </div>
</div>
@endsection