@extends('layouts.app')

@section('title', 'Nạp Tiền - Shop Acc FC Online')
@section('description', 'Nạp tiền vào tài khoản VanhFCO.com nhanh chóng, an toàn qua chuyển khoản ngân hàng.')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-extrabold uppercase tracking-tight text-slate-900 mb-2 flex justify-center items-center gap-3">
            <span class="material-icons text-primary-green">account_balance</span>
            THÔNG TIN NGÂN HÀNG & VÍ
        </h1>
        <div class="h-1 w-24 bg-primary-green mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Bank Info Card -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl border border-slate-200">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 p-4 flex justify-between items-center text-white">
                    <span class="font-bold uppercase tracking-wider flex items-center gap-2">
                        <span class="material-icons text-sm">info</span> THÔNG TIN
                    </span>
                    <span class="font-bold uppercase tracking-wider">SỐ TÀI KHOẢN</span>
                </div>
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="flex-1 w-full space-y-6">
                            <div>
                                <p class="text-slate-500 text-xs uppercase font-bold mb-1 tracking-widest">Ngân hàng</p>
                                <p class="text-2xl font-black text-slate-900 italic">{{ $banking }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs uppercase font-bold mb-1 tracking-widest">Chủ tài khoản</p>
                                <p class="text-xl font-bold text-slate-900">{{ $bankName }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs uppercase font-bold mb-2 tracking-widest">Số tài khoản</p>
                                <div class="flex items-center gap-2">
                                    <div class="bg-slate-100 px-4 py-3 rounded-xl border border-slate-200 flex-1">
                                        <span class="text-2xl font-mono font-bold text-primary-green">{{ $bankNumber }}</span>
                                    </div>
                                    <button class="bg-primary-green hover:bg-primary-green/80 text-white h-full px-4 rounded-xl transition-all active:scale-95 flex items-center justify-center" onclick="navigator.clipboard.writeText('{{ $bankNumber }}')">
                                        <span class="material-icons">content_copy</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <div class="bg-white p-3 rounded-2xl shadow-lg border-4 border-primary-green/20">
                                <img alt="QR Code Bank Transfer" class="w-44 h-44" src="https://img.vietqr.io/image/{{ $bankBin }}-{{ $bankNumber }}-compact2.png?amount=0&addInfo=vanhfco%20{{ Auth::id() }}&accountName={{ urlencode($bankName) }}">
                                <div class="mt-2 text-center">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter">Quét mã để nạp nhanh</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 p-4 rounded-xl bg-primary-green/10 border border-primary-green/20">
                        <p class="text-sm text-primary-green leading-relaxed font-medium">
                            <span class="material-icons text-xs align-middle">error</span>
                            Vui lòng ghi đúng nội dung ở mục <strong>Nội dung chuyển tiền</strong> để cập nhật số dư ngay lập tức.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl overflow-hidden h-full flex flex-col shadow-xl border border-slate-200">
                <div class="bg-slate-50 p-4 border-b border-slate-200">
                    <span class="font-bold uppercase tracking-wider flex items-center gap-2 text-slate-800">
                        <span class="material-icons text-primary-green">description</span> HƯỚNG DẪN NẠP TIỀN
                    </span>
                </div>
                <div class="p-8 flex-1 space-y-8">
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold uppercase text-slate-500 tracking-widest">Nội dung chuyển tiền bắt buộc</h3>
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-primary-green to-blue-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000"></div>
                            <div class="relative bg-slate-900 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4 border border-slate-700">
                                <div class="flex items-center gap-4">
                                    <span class="material-icons text-primary-green text-3xl">terminal</span>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Copy nội dung này</p>
                                        <p class="text-2xl font-black text-white italic tracking-wider">vanhfco {{ Auth::id() }}</p>
                                    </div>
                                </div>
                                <button class="bg-primary-green/20 hover:bg-primary-green text-primary-green hover:text-white px-6 py-3 rounded-lg font-bold transition flex items-center gap-2" onclick="navigator.clipboard.writeText('vanhfco {{ Auth::id() }}')">
                                    <span class="material-icons text-sm">content_copy</span> COPY NGAY
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-primary-green/10 text-primary-green border border-primary-green/30 flex items-center justify-center font-bold">1</div>
                            <div>
                                <p class="text-slate-600">Đăng nhập ứng dụng Mobile Banking, chọn chức năng <strong>Scan QR</strong>, quét mã QR bên cạnh (hoặc điền STK và tên Ngân Hàng theo cách thủ công thông thường).</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-primary-green/10 text-primary-green border border-primary-green/30 flex items-center justify-center font-bold">2</div>
                            <div>
                                <p class="text-slate-600">Nhập số tiền muốn nạp và nội dung chuyển khoản <strong>đúng cú pháp</strong>. Kiểm tra các thông tin trước khi thực hiện chuyển tiền.</p>
                            </div>
                        </div>
                        <div class="bg-pink-500/5 border border-pink-500/20 rounded-xl p-6 space-y-3">
                            <p class="text-pink-500 font-black text-center text-lg italic">NẠP TIỀN VÀO</p>
                            <p class="text-slate-700 font-bold text-center border-y border-pink-500/20 py-2">STK: {{ $bankNumber }} - MBBANK - {{ $bankName }}</p>
                            <p class="text-pink-500 font-bold text-center text-xs uppercase tracking-widest">Nội dung: "vanhfco [ID]" (Trong đó ID là số ID User của quý khách)</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-primary-green/10 text-primary-green border border-primary-green/30 flex items-center justify-center font-bold">3</div>
                            <div>
                                <p class="text-slate-600">Xác nhận thanh toán và hoàn tất giao dịch. <span class="bg-yellow-400/20 text-yellow-600 font-bold px-1 rounded">Số dư sẽ được cập nhật tự động NGAY LẬP TỨC</span> tại website vanhfco.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection