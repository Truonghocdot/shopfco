@extends('layouts.app')

@section('title', 'Tài khoản - VanhFCO | Quản lý & Hoa hồng giới thiệu')
@section('description', 'Quản lý tài khoản VanhFCO, xem lịch sử mua Acc chứa FC, Acc Mở thẻ, theo dõi hoa hồng giới thiệu và số dư ví.')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8" x-data="{ activeTab: 'info' }">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tài khoản', 'url' => route('user.profile')]
    ]" />

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
        <span class="material-icons">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-4 border border-red-200 text-red-600 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full lg:w-64 shrink-0">
            <div class="flex flex-col gap-6 sticky top-24">
                <div class="bg-white rounded-xl border border-gray-200 shadow-md p-4">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 border-2 border-primary" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVGaTwIrah77vJVAoTY2oc_aYDyOz5LSOrCGtbT5xJGT8vhdJvPOeQhIfBXNGNP1OqlZ6rjdWRwY4Mvx_HLW1et0PwzS_48fJA9OLtGrnJjhVdHO7LwLY3lHSfwiMXSZiJFKYF7iMtWE5zyEJMiCP8WTJyqpKenn1bOSaBIENdAPC8fapysJ-DAqblpdj0C_bv17YfZMqWv_n4NyPWgJumLLYNtr7AUfCnVI5C_5JWL09YXcVEfripuVOhgYaLq2aWga_ajQXo9m-e");'></div>
                        <div class="flex flex-col">
                            <h1 class="text-gray-800 text-base font-black">{{ Auth::user()->name }}</h1>
                            <p class="text-primary text-xs font-bold uppercase tracking-wider">Thành viên</p>
                        </div>
                    </div>
                    <nav class="flex flex-col gap-2">
                        <button @click="activeTab = 'info'"
                            :class="activeTab === 'info' ? 'text-primary border-primary/30' : 'text-gray-500 hover:bg-gray-50 border-transparent'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border transition-all text-left w-full">
                            <span class="material-icons text-[20px]">person</span>
                            <p class="text-sm font-bold">Thông tin tài khoản</p>
                        </button>
                        <button @click="activeTab = 'orders'"
                            :class="activeTab === 'orders' ? 'text-primary border-primary/30' : 'text-gray-500 hover:bg-gray-50 border-transparent'"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg border transition-all text-left w-full">
                            <span class="material-icons text-[20px]">shopping_bag</span>
                            <p class="text-sm font-bold">Tài khoản đã mua</p>
                        </button>
                    </nav>
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a href="{{ route('deposit') }}" class="w-full flex cursor-pointer items-center justify-center rounded-lg h-11 px-4 btn-tet text-sm uppercase tracking-wide">
                            <span class="material-icons mr-2 text-[20px]">add_circle</span>
                            <span>Nạp tiền ngay</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-w-0">
            <div x-show="activeTab === 'info'" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Wallet Info -->
                    <div class="bg-gradient-to-br from-primary to-orange-500 rounded-xl p-6 text-white shadow-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="size-10 rounded-lg bg-white/20 flex items-center justify-center">
                                <span class="material-icons">account_balance_wallet</span>
                            </div>
                            <span class="text-xs font-black bg-white/20 px-2 py-1 rounded">VND</span>
                        </div>
                        <p class="text-white/80 text-sm font-bold mb-1">Số dư khả dụng</p>
                        <h3 class="text-2xl font-black">{{ number_format(Auth::user()->wallet->balance ?? 0) }}đ</h3>
                    </div>
                </div>

                <livewire:user.profile-info wire:key="profile-info-content" />
            </div>

            <div x-show="activeTab === 'orders'" class="space-y-6" style="display: none;">
                <livewire:user.purchased-products wire:key="purchased-products-content" />
            </div>
        </div>
    </div>
</div>
@endsection