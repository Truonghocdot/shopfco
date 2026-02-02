@extends('layouts.app')

@section('title', 'Thanh toán thành công')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center p-8 md:p-12">
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-icons text-5xl text-green-600">check_circle</span>
            </div>

            <h1 class="text-3xl font-black text-slate-900 mb-2">Thanh toán thành công!</h1>
            <p class="text-slate-500 mb-8">Cảm ơn bạn đã mua hàng. Dưới đây là thông tin đơn hàng của bạn.</p>

            <!-- Bill Details -->
            <div class="bg-slate-50 rounded-xl p-6 border border-slate-200 text-left mb-8">
                <div class="flex justify-between items-center pb-4 border-b border-slate-200 mb-4">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-bold">Mã đơn hàng</p>
                        <p class="font-mono font-bold text-lg text-slate-900">#{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-500 uppercase font-bold">Ngày mua</p>
                        <p class="font-medium text-slate-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="flex gap-4 mb-6">
                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-white border border-slate-200 shrink-0">
                        @if(isset($order->product->images[0]))
                        <img src="{{ url('storage/'.$order->product->images[0]) }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <span class="material-icons">image</span>
                        </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900">{{ $order->product->title ?? 'Sản phẩm' }}</h3>
                        <p class="text-sm text-slate-500">{{ $order->product->category->title ?? 'Danh mục' }}</p>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="bg-white rounded-lg border border-dashed border-primary/30 p-4 mb-4">
                    <h4 class="font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <span class="material-icons text-primary text-sm">vpn_key</span>
                        Thông tin tài khoản
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Tài khoản</span>
                            <code class="block bg-slate-100 p-2 rounded text-sm font-mono font-bold select-all">N/A</code>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Mật khẩu</span>
                            <code class="block bg-slate-100 p-2 rounded text-sm font-mono font-bold select-all">N/A</code>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Mật khẩu 2</span>
                            <code class="block bg-slate-100 p-2 rounded text-sm font-mono font-bold select-all">{{ $order->product->password2 ?? 'N/A' }}</code>
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-slate-600">
                        <span class="font-bold">Ghi chú:</span> Sử dụng Mật khẩu 2 để  lấy thông tin tài khoản trong trang quản lý đơn hàng <a href="{{ route('user.profile') }}" class="text-primary hover:underline">Xem chi tiết</a>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="space-y-2 text-sm pt-4 border-t border-slate-200">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Giá gốc</span>
                        <span class="font-medium">{{ number_format($order->product_price) }}đ</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Giảm giá</span>
                        <span>-{{ number_format($order->discount_amount) }}đ</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-lg font-black text-slate-900 pt-2">
                        <span>Tổng thanh toán</span>
                        <span class="text-accent-red">{{ number_format($order->final_amount) }}đ</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('home') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition">
                    Về trang chủ
                </a>
                <a href="{{ route('user.profile') }}" class="px-6 py-3 bg-primary hover:bg-primary/80 text-white font-bold rounded-xl transition">
                    Xem lịch sử mua hàng
                </a>
            </div>
        </div>
    </div>
</div>
@endsection