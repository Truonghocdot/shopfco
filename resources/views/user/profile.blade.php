@extends('layouts.app')

@section('title', 'Tài khoản - VanhFCO | Quản lý & Hoa hồng giới thiệu')
@section('description', 'Quản lý tài khoản VanhFCO, xem lịch sử mua Acc chứa FC, Acc Mở thẻ, theo dõi hoa hồng giới thiệu và số dư ví.')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8" x-data="{ activeTab: 'info' }">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tài khoản', 'url' => route('user.profile')]
    ]" />

    @if(session('success'))
    <div class="mb-4 p-4 bg-primary/20 border-2 border-primary/50 text-primary rounded-lg flex items-center gap-2 shadow-[0_0_15px_rgba(0,255,0,0.3)]">
        <span class="material-icons">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-4 bg-red-900/30 border-2 border-red-500/50 text-red-300 rounded-lg shadow-[0_0_15px_rgba(239,68,68,0.3)]">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation - Techno Style -->
        <aside class="w-full lg:w-64 shrink-0">
            <div class="flex flex-col gap-6 sticky top-24">
                <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 p-4 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] overflow-hidden">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <div class="flex items-center gap-3 mb-6 relative z-10">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 border-2 border-primary shadow-[0_0_15px_rgba(0,255,0,0.5)]" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVGaTwIrah77vJVAoTY2oc_aYDyOz5LSOrCGtbT5xJGT8vhdJvPOeQhIfBXNGNP1OqlZ6rjdWRwY4Mvx_HLW1et0PwzS_48fJA9OLtGrnJjhVdHO7LwLY3lHSfwiMXSZiJFKYF7iMtWE5zyEJMiCP8WTJyqpKenn1bOSaBIENdAPC8fapysJ-DAqblpdj0C_bv17YfZMqWv_n4NyPWgJumLLYNtr7AUfCnVI5C_5JWL09YXcVEfripuVOhgYaLq2aWga_ajQXo9m-e");'></div>
                        <div class="flex flex-col">
                            <h1 class="text-white text-base font-black">{{ Auth::user()->name }}</h1>
                            <p class="text-primary text-xs font-bold uppercase tracking-wider drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">Thành viên</p>
                        </div>
                    </div>
                    <nav class="flex flex-col gap-2 relative z-10">
                        <button @click="activeTab = 'info'"
                            :class="activeTab === 'info' ? 'bg-primary/20 text-primary border-primary/50 shadow-[0_0_15px_rgba(0,255,0,0.3)]' : 'text-slate-400 hover:bg-black/40 border-slate-700'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border-2 transition-all text-left w-full">
                            <span class="material-icons text-[20px]" :class="activeTab === 'info' ? 'fill-1' : ''">person</span>
                            <p class="text-sm font-bold">Thông tin tài khoản</p>
                        </button>
                        <button @click="activeTab = 'orders'"
                            :class="activeTab === 'orders' ? 'bg-primary/20 text-primary border-primary/50 shadow-[0_0_15px_rgba(0,255,0,0.3)]' : 'text-slate-400 hover:bg-black/40 border-slate-700'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border-2 transition-all text-left w-full">
                            <span class="material-icons text-[20px]" :class="activeTab === 'orders' ? 'fill-1' : ''">shopping_bag</span>
                            <p class="text-sm font-bold">Tài khoản đã mua</p>
                        </button>
                    </nav>
                    <div class="mt-6 pt-6 border-t-2 border-primary/20 relative z-10">
                        <a href="{{ route('deposit') }}" class="w-full text-black flex cursor-pointer items-center justify-center rounded-lg h-11 px-4 bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-sm font-black shadow-[0_0_20px_rgba(0,255,0,0.4)] hover:shadow-[0_0_30px_rgba(0,255,0,0.6)] transition-all border-2 border-primary/50 uppercase tracking-wide">
                            <span class="material-icons mr-2 text-[20px]">add_circle</span>
                            <span>Nạp tiền ngay</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-w-0">
            <!-- Account Info Tab -->
            <div x-show="activeTab === 'info'" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Wallet Info - Techno Style -->
                    <div class="relative bg-gradient-to-br from-primary to-green-400 rounded-xl p-6 text-black shadow-[0_0_30px_rgba(0,255,0,0.4)] overflow-hidden">
                        <div class="absolute inset-0 opacity-10 pointer-events-none">
                            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 0, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 0, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                        </div>

                        <div class="flex items-start justify-between mb-4 relative z-10">
                            <div class="size-10 rounded-lg bg-black/20 flex items-center justify-center">
                                <span class="material-icons">account_balance_wallet</span>
                            </div>
                            <span class="text-xs font-black bg-black/20 px-2 py-1 rounded">VND</span>
                        </div>
                        <p class="text-black/70 text-sm font-bold mb-1 relative z-10">Số dư khả dụng</p>
                        <h3 class="text-2xl font-black relative z-10">{{ number_format(Auth::user()->wallet->balance ?? 0) }}đ</h3>
                    </div>
                </div>

                <!-- Update Info Form (Livewire) -->
                <livewire:user.profile-info wire:key="profile-info-content" />
            </div>

            <!-- Purchased Accounts Tab -->
            <div x-show="activeTab === 'orders'" class="space-y-6" style="display: none;">
                <!-- Purchased Accounts List (Livewire) -->
                <livewire:user.purchased-products wire:key="purchased-products-content" />
            </div>
        </div>
    </div>
</div>
@endsection