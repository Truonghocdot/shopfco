@extends('layouts.app')

@section('title', 'Đăng ký thành viên - VanhFCO.com')
@section('description', 'Tạo tài khoản mới tại Shop Acc FC Online để nhận nhiều ưu đãi và mua bán tài khoản dễ dàng.')

@section('content')
<div class="min-h-[calc(100vh-250px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-3xl h-full max-h-3xl bg-primary/5 blur-[150px] rounded-full pointer-events-none"></div>

    <div class="max-w-md w-full space-y-8 glass p-8 md:p-12 rounded-[2.5rem] shadow-2xl border border-white/10 relative z-10 group">
        <!-- Inner glow effect on group hover -->
        <div class="absolute -inset-1 bg-linear-to-r from-primary/20 to-indigo-500/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none rounded-[2.5rem]"></div>

        <div class="text-center relative">
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter mb-2 italic">
                ĐĂNG KÝ <span class="text-primary drop-shadow-[0_0_8px_rgba(56,189,248,0.5)]">THÀNH VIÊN</span>
            </h1>
            <p class="text-xs font-bold text-white uppercase tracking-widest">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-primary hover:text-white transition-colors underline underline-offset-4 decoration-primary/30">
                    ĐĂNG NHẬP NGAY
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6 relative" action="{{ route('register') }}" method="POST" x-data="{ showPassword: false }">
            @csrf

            <div class="space-y-4">
                <!-- Username -->
                <div>
                    <label for="username" class="block text-[10px] font-black text-white mb-2 ml-4 uppercase tracking-[0.2em]">TÊN ĐĂNG NHẬP</label>
                    <div class="relative group/field">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 transition-colors group-hover/field:text-primary">
                            <span class="material-icons text-sm">person</span>
                        </span>
                        <input id="username" name="username" type="text" autocomplete="username" required
                            class="appearance-none rounded-2xl relative block w-full pl-11 pr-4 py-4 bg-slate-900/80 border border-white/10 placeholder-slate-600 text-white focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary sm:text-sm font-bold tracking-tight transition-all shadow-inner"
                            placeholder="Nhập tên đăng nhập..." value="{{ old('username') }}">
                    </div>
                    @error('username')
                    <p class="mt-2 ml-4 text-[10px] font-black text-pink-500 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-[10px] font-black text-white mb-2 ml-4 uppercase tracking-[0.2em]">MẬT KHẨU</label>
                    <div class="relative group/field">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 transition-colors group-hover/field:text-primary">
                            <span class="material-icons text-sm">lock</span>
                        </span>
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="new-password" required
                            class="appearance-none rounded-2xl relative block w-full pl-11 pr-12 py-4 bg-slate-900/80 border border-white/10 placeholder-slate-600 text-white focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary sm:text-sm font-bold tracking-tight transition-all shadow-inner"
                            placeholder="Tối thiểu 8 ký tự">
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-white transition-colors cursor-pointer outline-none">
                            <span class="material-icons text-sm" x-show="!showPassword">visibility</span>
                            <span class="material-icons text-sm" x-show="showPassword" x-cloak>visibility_off</span>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-2 ml-4 text-[10px] font-black text-pink-500 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black text-white mb-2 ml-4 uppercase tracking-[0.2em]">XÁC NHẬN MẬT KHẨU</label>
                    <div class="relative group/field">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 transition-colors group-hover/field:text-primary">
                            <span class="material-icons text-sm">lock_clock</span>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" :type="showPassword ? 'text' : 'password'" autocomplete="new-password" required
                            class="appearance-none rounded-2xl relative block w-full pl-11 pr-4 py-4 bg-slate-900/80 border border-white/10 placeholder-slate-600 text-white focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary sm:text-sm font-bold tracking-tight transition-all shadow-inner"
                            placeholder="Nhập lại mật khẩu...">
                    </div>
                </div>

                <!-- Referrer ID -->
                <div>
                    <label for="referrer_id" class="block text-[10px] font-black text-white mb-2 ml-4 uppercase tracking-[0.2em]">MÃ GIỚI THIỆU (TÙY CHỌN)</label>
                    <div class="relative group/field">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 transition-colors group-hover/field:text-primary">
                            <span class="material-icons text-sm">group_add</span>
                        </span>
                        <input id="referrer_id" name="referrer_id" type="text"
                            class="appearance-none rounded-2xl relative block w-full pl-11 pr-4 py-4 bg-slate-900/80 border border-white/10 placeholder-slate-600 text-white focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary sm:text-sm font-bold tracking-tight transition-all shadow-inner"
                            placeholder="Nhập mã giới thiệu..."
                            value="{{ request('ref') ?? old('referrer_id') }}">
                    </div>
                    <p class="mt-2 ml-4 text-[9px] font-bold text-white uppercase tracking-widest leading-relaxed">Nhập mã giới thiệu để nhận ưu đãi từ hệ thống</p>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="group relative w-full flex justify-center py-5 px-4 border-none text-xs font-black rounded-2xl text-white btn-esport shadow-2xl shadow-primary/20 active:scale-95 transition-all overflow-hidden uppercase tracking-[0.2em]">
                    <span class="flex items-center gap-2 relative z-10 transition-all group-hover:gap-3">
                        <span class="material-icons text-sm">person_add</span>
                        ĐĂNG KÝ THÀNH VIÊN
                    </span>
                    <div class="absolute inset-y-0 left-0 w-12 bg-linear-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-[400px] transition-transform duration-1000 ease-in-out"></div>
                </button>
            </div>

            <p class="text-[9px] text-slate-600 font-bold text-center mt-6 leading-relaxed uppercase tracking-widest max-w-[280px] mx-auto">
                Bằng việc đăng ký, bạn đồng ý với <a href="#" class="text-primary hover:text-white transition-colors underline underline-offset-4">Điều khoản dịch vụ</a> và <a href="#" class="text-primary hover:text-white transition-colors underline underline-offset-4">Chính sách bảo mật</a>.
            </p>
        </form>
    </div>
</div>
@endsection