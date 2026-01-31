@extends('layouts.app')

@section('title', 'Tài khoản người dùng - FC Online Shop')
@section('description', 'Quản lý thông tin tài khoản và lịch sử giao dịch của bạn.')

@push('styles')
<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuBsKRObr_MVqVSUYzPo-guc9soauRLmFJkvOfA5NJc8IWI0XazSVu7WJsY8o8kfBvO5heKgomdMEML4GoG44D4PjL-ZHyhOcCC499d22XF4In7K5cptXa6JgtEe2sF_Q9_IucnRuEOZATiTFkdsM7_fLgxidde6clT9GB8G3q164eje8YDNNa6CVTpwYVG2uvcb4rNP0h3rY-tQ61PZKriHLKVUhBGF7bFLp_d4vyjJqGJQRo8LjH47LlBS1Ug2U3dD5ogNnWufQ90);
        background-attachment: fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8" x-data="{ activeTab: 'info' }">
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg flex items-center gap-2">
        <span class="material-icons">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 shrink-0">
            <div class="flex flex-col gap-6 sticky top-24">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 border-2 border-primary-blue" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVGaTwIrah77vJVAoTY2oc_aYDyOz5LSOrCGtbT5xJGT8vhdJvPOeQhIfBXNGNP1OqlZ6rjdWRwY4Mvx_HLW1et0PwzS_48fJA9OLtGrnJjhVdHO7LwLY3lHSfwiMXSZiJFKYF7iMtWE5zyEJMiCP8WTJyqpKenn1bOSaBIENdAPC8fapysJ-DAqblpdj0C_bv17YfZMqWv_n4NyPWgJumLLYNtr7AUfCnVI5C_5JWL09YXcVEfripuVOhgYaLq2aWga_ajQXo9m-e");'></div>
                        <div class="flex flex-col">
                            <h1 class="text-slate-900 text-base font-bold">{{ Auth::user()->name }}</h1>
                            <p class="text-primary-blue text-xs font-semibold uppercase tracking-wider">Thành viên</p>
                        </div>
                    </div>
                    <nav class="flex flex-col gap-2">
                        <button @click="activeTab = 'info'"
                            :class="activeTab === 'info' ? 'bg-primary-blue/10 text-primary-blue border-primary-blue/20' : 'text-slate-600 hover:bg-slate-50'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border border-transparent transition-colors text-left w-full">
                            <span class="material-icons text-[20px]" :class="activeTab === 'info' ? 'fill-1' : ''">person</span>
                            <p class="text-sm font-semibold">Thông tin tài khoản</p>
                        </button>
                        <button @click="activeTab = 'orders'"
                            :class="activeTab === 'orders' ? 'bg-primary-blue/10 text-primary-blue border-primary-blue/20' : 'text-slate-600 hover:bg-slate-50'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border border-transparent transition-colors text-left w-full">
                            <span class="material-icons text-[20px]" :class="activeTab === 'orders' ? 'fill-1' : ''">shopping_bag</span>
                            <p class="text-sm font-semibold">Tài khoản đã mua</p>
                        </button>
                    </nav>
                    <div class="mt-6 pt-6 border-t  border-slate-200">
                        <a href="{{ route('deposit') }}" class="w-full text-slate-800 flex cursor-pointer items-center justify-center rounded-lg h-11 px-4 bg-primary-blue text-sm font-bold shadow-lg shadow-primary-blue/25 hover:bg-primary-blue/90 transition-colors">
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
                    <!-- Wallet Info -->
                    <div class="bg-gradient-to-br from-primary-blue to-blue-600 rounded-xl p-6 text-white shadow-lg shadow-primary-blue/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="size-10 rounded-lg bg-white/20 flex items-center justify-center">
                                <span class="material-icons">account_balance_wallet</span>
                            </div>
                            <span class="text-xs font-bold bg-white/20 px-2 py-1 rounded">VND</span>
                        </div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Số dư khả dụng</p>
                        <h3 class="text-2xl font-bold">{{ number_format(Auth::user()->wallet->balance ?? 0) }}đ</h3>
                    </div>
                </div>

                <!-- Update Info Form (Livewire) -->
                @livewire('user.profile-info')
            </div>

            <!-- Purchased Accounts Tab -->
            <div x-show="activeTab === 'orders'" class="space-y-6" style="display: none;">
                <!-- Purchased Accounts List (Livewire) -->
                @livewire('user.purchased-products')
            </div>
        </div>
    </div>
</div>
@endsection