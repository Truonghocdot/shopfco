@extends('layouts.app')

@section('title', 'Nạp Tiền - VanhFCO | AccFCO - Nhanh Chóng & An Toàn')
@section('description', 'Nạp tiền vào tài khoản VanhFCO để mua Acc chứa FC, Acc Mở thẻ, Acc đội hình. Chuyển khoản ngân hàng tự động, nhanh chóng, an toàn.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Nạp tiền', 'url' => route('deposit')]
    ]" />

    <!-- Page Header -->
    <div class="mb-10 text-center relative">
        <!-- Floating decorations around header -->
        <img src="{{ asset('images/hoa1.webp') }}" class="absolute -top-10 left-10 w-32 opacity-70 animate-shake hidden md:block">
        <img src="{{ asset('images/phao1.webp') }}" class="absolute -top-10 right-10 w-24 opacity-80 animate-swing hidden md:block">

        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3 relative z-10">
            <span class="material-icons text-4xl md:text-5xl">account_balance_wallet</span>
            NẠP TIỀN TỰ ĐỘNG
        </h1>
        <p class="text-gray-500 font-bold uppercase tracking-widest text-sm">Nạp nhanh - Duyệt tự động - An toàn tuyệt đối</p>
        <div class="h-1.5 w-48 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-6"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-xl relative group">
                <!-- Inner decoration -->
                <img src="{{ asset('images/hoa3.webp') }}" class="absolute -bottom-6 -left-6 w-32 opacity-80 pointer-events-none z-0 animate-shake">

                <!-- Header -->
                <div class="bg-linear-to-r from-primary to-orange-500 p-5 flex justify-between items-center relative z-10">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-white">
                        <span class="material-icons">credit_card</span> THÔNG TIN CHUYỂN KHOẢN
                    </span>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                        <span class="text-[10px] text-white/80 font-bold uppercase tracking-tighter">Hệ thống online</span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-xs uppercase font-bold mb-2 tracking-widest">Ngân hàng</p>
                                <div class="border border-gray-200 rounded-lg px-4 py-3">
                                    <p class="text-xl font-black text-primary italic">{{ $banking }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs uppercase font-bold mb-2 tracking-widest">Chủ tài khoản</p>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                                    <p class="text-lg font-bold text-gray-800 uppercase">{{ $bankName }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="relative z-10">
                            <p class="text-gray-400 text-xs uppercase font-bold mb-2 tracking-widest">Số tài khoản</p>
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-50 border-2 border-primary/20 hover:border-primary/40 transition-colors px-5 py-4 rounded-xl flex-1 group/acc">
                                    <span class="text-3xl font-mono font-black text-primary tracking-tighter">{{ $bankNumber }}</span>
                                </div>
                                <button class="btn-tet h-full px-5 py-4 rounded-xl transition-all hover-glow-gold active:scale-95 flex items-center justify-center shrink-0" onclick="navigator.clipboard.writeText('{{ $bankNumber }}')">
                                    <span class="material-icons">content_copy</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div class="flex justify-center pt-8 mt-8 border-t border-gray-100 relative z-10">
                        <div class="bg-white p-5 rounded-3xl border border-gray-200 shadow-2xl flex flex-col items-center relative active:scale-[1.05] transition-transform duration-300">
                            <!-- Corner firework in QR -->
                            <img src="{{ asset('images/phao2.webp') }}" class="absolute -top-4 -right-4 w-16 opacity-90 animate-swing">

                            <div class="p-2 border-2 border-primary/10 rounded-2xl">
                                <img alt="QR Code Bank Transfer" class="w-64 h-64 rounded-xl" src="https://api.vietqr.io/image/{{ $bankBin }}-{{ $bankNumber }}-compact2.png?amount=0&addInfo=vanhfco%20{{ Auth::id() }}&accountName={{ urlencode($bankName) }}">
                            </div>
                            <div class="mt-5 text-center">
                                <div class="inline-block bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full mb-2">VietQR 2.0</div>
                                <p class="text-base text-gray-800 font-black uppercase tracking-wide">Quét mã để nạp nhanh</p>
                                <p class="text-xs text-orange-500 font-bold mt-1 uppercase">Xử lý tự động trong tích tắc</p>
                            </div>
                        </div>
                    </div>

                    <!-- Warning -->
                    <div class="mt-6 p-4 rounded-xl bg-orange-50 border border-orange-200">
                        <p class="text-sm text-orange-600 leading-relaxed font-bold flex items-start gap-2">
                            <span class="material-icons text-base shrink-0">error</span>
                            <span>Vui lòng ghi <strong class="text-primary">đúng nội dung</strong> ở mục <strong class="text-primary">Nội dung chuyển tiền</strong> để cập nhật số dư ngay lập tức.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl overflow-hidden h-full flex flex-col border border-gray-200 shadow-xl relative">
                <!-- Decorative flower corner -->
                <img src="{{ asset('images/hoa2.webp') }}" class="absolute -top-6 -right-6 w-40 opacity-70 pointer-events-none z-0 animate-shake">

                <!-- Header -->
                <div class="bg-linear-to-r from-primary to-orange-500 p-5 relative z-10">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-white">
                        <span class="material-icons">help_outline</span> CÁC BƯỚC THỰC HIỆN
                    </span>
                </div>

                <!-- Content -->
                <div class="p-8 flex-1 space-y-8">
                    <!-- Transfer Content Section -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-black uppercase text-gray-400 tracking-widest flex items-center gap-2">
                            <span class="material-icons text-primary text-sm">vpn_key</span>
                            Nội dung chuyển tiền bắt buộc
                        </h3>
                        <div class="bg-primary/5 border-2 border-primary/30 rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group/content">
                            <!-- Background pattern -->
                            <div class="absolute inset-0 bg-primary opacity-0 group-hover/content:opacity-[0.03] transition-opacity duration-500"></div>

                            <div class="flex items-center gap-5 relative z-10">
                                <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-white shadow-lg">
                                    <span class="material-icons text-4xl">vpn_key</span>
                                </div>
                                <div>
                                    <p class="text-xs text-primary font-black uppercase tracking-widest mb-1">Nội dung chuyển tiền</p>
                                    <p class="text-3xl font-black text-gray-800 italic tracking-wider">vanhfco {{ Auth::id() }}</p>
                                </div>
                            </div>
                            <button class="btn-tet px-8 py-5 rounded-2xl flex items-center gap-2 font-black text-base shadow-xl hover-glow-gold transition-all active:scale-95 relative z-10" onclick="navigator.clipboard.writeText('vanhfco {{ Auth::id() }}')">
                                <span class="material-icons">content_copy</span> SAO CHÉP
                            </button>
                        </div>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center font-black text-lg">1</div>
                            <div class="flex-1">
                                <p class="text-gray-600 leading-relaxed">Đăng nhập ứng dụng Mobile Banking, chọn chức năng <strong class="text-primary">Scan QR</strong>, quét mã QR bên cạnh (hoặc điền STK và tên Ngân Hàng theo cách thủ công thông thường).</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center font-black text-lg">2</div>
                            <div class="flex-1">
                                <p class="text-gray-600 leading-relaxed">Nhập số tiền muốn nạp và nội dung chuyển khoản <strong class="text-primary">đúng cú pháp</strong>. Kiểm tra các thông tin trước khi thực hiện chuyển tiền.</p>
                            </div>
                        </div>

                        <!-- Important Notice -->
                        <div class="bg-linear-to-br from-red-600 to-orange-600 rounded-2xl p-8 space-y-4 shadow-2xl relative overflow-hidden group/notice">
                            <!-- Shine effect -->
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover/notice:translate-x-[100%] transition-transform duration-1000"></div>

                            <p class="text-yellow-300 font-black text-center text-2xl italic uppercase tracking-widest relative z-10">LƯU Ý QUAN TRỌNG</p>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl py-4 px-6 relative z-10 border border-white/20">
                                <p class="text-white font-black text-center text-lg">STK: <span class="text-yellow-300">{{ $bankNumber }}</span> - <span class="text-yellow-300">MBBANK</span></p>
                                <p class="text-white/90 text-center font-bold">{{ $bankName }}</p>
                            </div>
                            <p class="text-white font-bold text-center text-sm uppercase tracking-widest leading-relaxed relative z-10">
                                Nội dung phải đúng: <span class="bg-yellow-400 text-primary px-2 py-0.5 rounded font-black">vanhfco {{ Auth::id() }}</span>
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center font-black text-lg">3</div>
                            <div class="flex-1">
                                <p class="text-gray-600 leading-relaxed">Xác nhận thanh toán và hoàn tất giao dịch. <span class="bg-orange-100 border border-orange-300 text-orange-600 font-black px-2 py-1 rounded">Số dư sẽ được cập nhật tự động NGAY LẬP TỨC</span> tại website vanhfco.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection