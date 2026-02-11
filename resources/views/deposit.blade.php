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
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3">
            <span class="material-icons text-4xl">account_balance_wallet</span>
            NẠP TIỀN VÀO TÀI KHOẢN
        </h1>
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-4"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Bank Info Card -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-md">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-orange-500 p-4 flex justify-between items-center">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-white">
                        <span class="material-icons text-sm">info</span> THÔNG TIN
                    </span>
                    <span class="font-black uppercase tracking-wider text-white">NGÂN HÀNG</span>
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
                        <div>
                            <p class="text-gray-400 text-xs uppercase font-bold mb-2 tracking-widest">Số tài khoản</p>
                            <div class="flex items-center gap-2">
                                <div class="border border-primary/30 px-4 py-3 rounded-lg flex-1">
                                    <span class="text-2xl font-mono font-black text-primary">{{ $bankNumber }}</span>
                                </div>
                                <button class="bg-primary hover:bg-primary-dark text-white h-full px-4 py-3 rounded-lg transition-all active:scale-95 flex items-center justify-center shrink-0" onclick="navigator.clipboard.writeText('{{ $bankNumber }}')">
                                    <span class="material-icons">content_copy</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div class="flex justify-center pt-6 mt-6 border-t border-gray-100">
                        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-md flex flex-col items-center">
                            <img alt="QR Code Bank Transfer" class="w-56 h-56 rounded-xl" src="https://api.vietqr.io/image/{{ $bankBin }}-{{ $bankNumber }}-compact2.png?amount=0&addInfo=vanhfco%20{{ Auth::id() }}&accountName={{ urlencode($bankName) }}">
                            <div class="mt-4 text-center">
                                <p class="text-sm text-primary font-black uppercase tracking-widest">Quét mã để nạp nhanh</p>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase">Hệ thống tự động duyệt sau 1-3 phút</p>
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
            <div class="bg-white rounded-2xl overflow-hidden h-full flex flex-col border border-gray-200 shadow-md">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-orange-500 p-4">
                    <span class="font-black uppercase tracking-wider flex items-center gap-2 text-white">
                        <span class="material-icons">description</span> HƯỚNG DẪN NẠP TIỀN
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
                        <div class="border border-primary/30 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <span class="material-icons text-primary text-4xl">terminal</span>
                                <div>
                                    <p class="text-xs text-gray-400 font-bold uppercase mb-1">Copy nội dung này</p>
                                    <p class="text-2xl font-black text-primary italic tracking-wider">vanhfco {{ Auth::id() }}</p>
                                </div>
                            </div>
                            <button class="btn-tet px-6 py-3 rounded-lg flex items-center gap-2" onclick="navigator.clipboard.writeText('vanhfco {{ Auth::id() }}')">
                                <span class="material-icons text-sm">content_copy</span> COPY NGAY
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
                        <div class="border border-red-200 rounded-xl p-6 space-y-3">
                            <p class="text-primary font-black text-center text-xl italic uppercase tracking-wider">Nạp tiền vào</p>
                            <p class="text-gray-700 font-bold text-center border-y border-red-200 py-3">STK: <span class="text-primary">{{ $bankNumber }}</span> - <span class="text-primary">MBBANK</span> - {{ $bankName }}</p>
                            <p class="text-primary font-bold text-center text-sm uppercase tracking-widest">Nội dung: "vanhfco [ID]" (Trong đó ID là số ID User của quý khách)</p>
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