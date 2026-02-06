@extends('layouts.app')

@section('title', 'Nạp Tiền - Shop Acc FC Online')
@section('description', 'Nạp tiền vào tài khoản VanhFCO.com nhanh chóng, an toàn qua chuyển khoản ngân hàng.')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-10 text-center relative">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
        </div>

        <h1 class="text-4xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3 drop-shadow-[0_0_20px_rgba(0,255,0,0.8)] relative z-10">
            <span class="material-icons text-4xl">account_balance_wallet</span>
            NẠP TIỀN VÀO TÀI KHOẢN
        </h1>
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-primary to-transparent mx-auto rounded-full shadow-[0_0_10px_rgba(0,255,0,0.8)]"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Bank Info Card -->
        <div class="lg:col-span-5 space-y-6">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black rounded-2xl overflow-hidden border-2 border-primary/30 shadow-[0_0_30px_rgba(0,255,0,0.2)]">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <!-- Scan Line Animation -->
                <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
                    <div class="h-full w-[200%] bg-gradient-to-r from-transparent via-primary/20 to-transparent animate-shimmer"></div>
                </div>

                <!-- Header -->
                <div class="bg-gradient-to-r from-primary/20 to-primary/10 p-4 flex justify-between items-center border-b-2 border-primary/30 relative z-10">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">
                        <span class="material-icons text-sm">info</span> THÔNG TIN
                    </span>
                    <span class="font-black uppercase tracking-wider text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">NGÂN HÀNG</span>
                </div>

                <!-- Content -->
                <div class="p-8 relative z-10">
                    <div class="grid grid-cols-1 gap-8">
                        <!-- Bank Details -->
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Bank Name -->
                                <div>
                                    <p class="text-slate-500 text-xs uppercase font-bold mb-2 tracking-widest">Ngân hàng</p>
                                    <div class="bg-black/40 border-2 border-slate-700 rounded-lg px-4 py-3 h-full flex items-center">
                                        <p class="text-xl font-black text-primary italic drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">{{ $banking }}</p>
                                    </div>
                                </div>

                                <!-- Account Holder -->
                                <div>
                                    <p class="text-slate-500 text-xs uppercase font-bold mb-2 tracking-widest">Chủ tài khoản</p>
                                    <div class="bg-black/40 border-2 border-slate-700 rounded-lg px-4 py-3 h-full flex items-center">
                                        <p class="text-lg font-bold text-white uppercase">{{ $bankName }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Number -->
                            <div>
                                <p class="text-slate-500 text-xs uppercase font-bold mb-2 tracking-widest">Số tài khoản</p>
                                <div class="flex items-center gap-2">
                                    <div class="bg-black/60 border-2 border-primary/50 px-4 py-3 rounded-lg flex-1 shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                                        <span class="text-2xl font-mono font-black text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">{{ $bankNumber }}</span>
                                    </div>
                                    <button class="bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 border-2 border-primary/50 text-primary h-full px-4 py-3 rounded-lg transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.5)] active:scale-95 flex items-center justify-center shrink-0" onclick="navigator.clipboard.writeText('{{ $bankNumber }}')">
                                        <span class="material-icons drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">content_copy</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Section - Full width on desktop for better visibility -->
                        <div class="flex justify-center pt-4 border-t border-primary/20">
                            <div class="relative group">
                                <div class="absolute -inset-1 bg-gradient-to-r from-primary/50 to-green-500/50 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                                <div class="relative bg-black/60 p-5 rounded-2xl border-4 border-primary/30 shadow-[0_0_40px_rgba(0,255,0,0.25)] flex flex-col items-center">
                                    <div class="absolute inset-0 bg-primary/5 rounded-2xl animate-pulse"></div>
                                    <img alt="QR Code Bank Transfer" class="w-56 h-56 relative z-10 rounded-xl shadow-[0_0_20px_rgba(0,0,0,0.5)] border border-primary/20" src="https://api.vietqr.io/image/{{ $bankBin }}-{{ $bankNumber }}-compact2.png?amount=0&addInfo=vanhfco%20{{ Auth::id() }}&accountName={{ urlencode($bankName) }}">
                                    <div class="mt-4 text-center relative z-10">
                                        <p class="text-sm text-primary font-black uppercase tracking-widest drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">Quét mã để nạp nhanh</p>
                                        <p class="text-[10px] text-slate-500 mt-1 uppercase">Hệ thống tự động duyệt sau 1-3 phút</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Warning Notice -->
                    <div class="mt-8 p-4 rounded-xl bg-primary/10 border-2 border-primary/30 shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                        <p class="text-sm text-primary leading-relaxed font-bold flex items-start gap-2">
                            <span class="material-icons text-base shrink-0 drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">error</span>
                            <span>Vui lòng ghi <strong class="text-white">đúng nội dung</strong> ở mục <strong class="text-white">Nội dung chuyển tiền</strong> để cập nhật số dư ngay lập tức.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="lg:col-span-7">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black rounded-2xl overflow-hidden h-full flex flex-col border-2 border-primary/30 shadow-[0_0_30px_rgba(0,255,0,0.2)]">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <!-- Header -->
                <div class="bg-gradient-to-r from-primary/20 to-primary/10 p-4 border-b-2 border-primary/30 relative z-10">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">
                        <span class="material-icons">description</span> HƯỚNG DẪN NẠP TIỀN
                    </span>
                </div>

                <!-- Content -->
                <div class="p-8 flex-1 space-y-8 relative z-10">
                    <!-- Transfer Content Section -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-black uppercase text-slate-400 tracking-widest flex items-center gap-2">
                            <span class="material-icons text-primary text-sm">vpn_key</span>
                            Nội dung chuyển tiền bắt buộc
                        </h3>
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary to-green-400 rounded-xl blur opacity-30 group-hover:opacity-60 transition duration-500"></div>
                            <div class="relative bg-black/80 border-2 border-primary/50 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4 shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                                <div class="flex items-center gap-4">
                                    <span class="material-icons text-primary text-4xl drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">terminal</span>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase mb-1">Copy nội dung này</p>
                                        <p class="text-2xl font-black text-primary italic tracking-wider drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">vanhfco {{ Auth::id() }}</p>
                                    </div>
                                </div>
                                <button class="bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary hover:to-green-400 border-2 border-primary/50 text-primary hover:text-black px-6 py-3 rounded-lg font-black transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.8)] active:scale-95 flex items-center gap-2" onclick="navigator.clipboard.writeText('vanhfco {{ Auth::id() }}')">
                                    <span class="material-icons text-sm">content_copy</span> COPY NGAY
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-6">
                        <!-- Step 1 -->
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10 text-primary border-2 border-primary/50 flex items-center justify-center font-black text-lg shadow-[0_0_10px_rgba(0,255,0,0.3)]">1</div>
                            <div class="flex-1">
                                <p class="text-slate-300 leading-relaxed">Đăng nhập ứng dụng Mobile Banking, chọn chức năng <strong class="text-primary">Scan QR</strong>, quét mã QR bên cạnh (hoặc điền STK và tên Ngân Hàng theo cách thủ công thông thường).</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10 text-primary border-2 border-primary/50 flex items-center justify-center font-black text-lg shadow-[0_0_10px_rgba(0,255,0,0.3)]">2</div>
                            <div class="flex-1">
                                <p class="text-slate-300 leading-relaxed">Nhập số tiền muốn nạp và nội dung chuyển khoản <strong class="text-primary">đúng cú pháp</strong>. Kiểm tra các thông tin trước khi thực hiện chuyển tiền.</p>
                            </div>
                        </div>

                        <!-- Important Notice -->
                        <div class="relative bg-gradient-to-br from-pink-500/10 to-red-500/10 border-2 border-pink-500/30 rounded-xl p-6 space-y-3 overflow-hidden shadow-[0_0_20px_rgba(236,72,153,0.2)]">
                            <div class="absolute inset-0 opacity-5 pointer-events-none">
                                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(236, 72, 153, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(236, 72, 153, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                            </div>
                            <p class="text-pink-500 font-black text-center text-xl italic uppercase tracking-wider drop-shadow-[0_0_10px_rgba(236,72,153,0.8)] relative z-10">Nạp tiền vào</p>
                            <p class="text-white font-bold text-center border-y-2 border-pink-500/30 py-3 relative z-10">STK: <span class="text-primary">{{ $bankNumber }}</span> - <span class="text-primary">MBBANK</span> - {{ $bankName }}</p>
                            <p class="text-primary font-bold text-center text-sm uppercase tracking-widest relative z-10">Nội dung: "vanhfco [ID]" (Trong đó ID là số ID User của quý khách)</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10 text-primary border-2 border-primary/50 flex items-center justify-center font-black text-lg shadow-[0_0_10px_rgba(0,255,0,0.3)]">3</div>
                            <div class="flex-1">
                                <p class="text-slate-300 leading-relaxed">Xác nhận thanh toán và hoàn tất giao dịch. <span class="bg-gradient-to-r from-yellow-400/20 to-orange-400/20 border border-yellow-400/30 text-yellow-400 font-black px-2 py-1 rounded shadow-[0_0_10px_rgba(250,204,21,0.3)]">Số dư sẽ được cập nhật tự động NGAY LẬP TỨC</span> tại website vanhfco.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection