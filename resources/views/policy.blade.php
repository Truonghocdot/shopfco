@extends('layouts.app')

@section('title', 'Chính Sách & Quy Định - VanhFCO')

@section('content')
<div class="policy-page relative overflow-hidden bg-black min-h-screen pt-12 pb-20">
    <!-- Fututistic Background Elements -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 40px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 40px);"></div>

        <!-- Scan Line -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-full h-[2px] bg-gradient-to-r from-transparent via-primary/30 to-transparent animate-scan-slow opacity-20"></div>
        </div>

        <!-- Glowing Orbs -->
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-primary/5 blur-[120px] rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Hero Section -->
        <div class="text-center mb-16 relative">
            <div class="inline-block relative mb-4">
                <div class="absolute inset-0 bg-primary blur-xl opacity-20 animate-pulse"></div>
                <div class="relative bg-gradient-to-br from-primary to-green-400 text-black px-8 py-3 font-black text-3xl italic rounded transform -skew-x-12 border-2 border-primary shadow-[0_0_20px_rgba(0,255,0,0.5)]">
                    CHÍNH SÁCH & QUY ĐỊNH
                </div>
            </div>
            <p class="text-primary font-bold tracking-[0.2em] uppercase text-sm drop-shadow-[0_0_8px_rgba(0,255,0,0.5)]">
                Security & Support System Protocol v1.0
            </p>
        </div>

        <!-- Policy Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <!-- OTP Policy -->
            <div class="techno-card group">
                <div class="card-glow"></div>
                <div class="relative z-10 flex gap-6">
                    <div class="techno-icon-box">
                        <span class="material-icons text-3xl">vips_access_control</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary animate-ping rounded-full"></span>
                            BẢO MẬT OTP
                        </h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Đối với những <span class="text-primary font-bold">Account có SĐT</span>, quý khách vui lòng liên hệ với shop để lấy mã OTP. Shop có trách nhiệm bảo lưu và bảo hành bảo mật tuyệt đối cho anh em.
                        </p>
                    </div>
                </div>
                <div class="corner-accents"></div>
            </div>

            <!-- Guarantee Policy -->
            <div class="techno-card group">
                <div class="card-glow"></div>
                <div class="relative z-10 flex gap-6">
                    <div class="techno-icon-box">
                        <span class="material-icons text-3xl">verified_user</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary animate-ping rounded-full"></span>
                            CHẤT LƯỢNG NICK
                        </h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Tài khoản <span class="text-primary font-bold">sạch 100%</span>, không tranh chấp. Shop cam kết <span class="text-primary font-bold">BẢO HÀNH TRỌN ĐỜI</span> cho tất cả giao dịch tại hệ thống.
                        </p>
                    </div>
                </div>
                <div class="corner-accents"></div>
            </div>

            <!-- Transaction Policy -->
            <div class="techno-card group">
                <div class="card-glow"></div>
                <div class="relative z-10 flex gap-6">
                    <div class="techno-icon-box">
                        <span class="material-icons text-3xl">handshake</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary animate-ping rounded-full"></span>
                            HỖ TRỢ GIAO DỊCH
                        </h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Sẵn sàng hỗ trợ <span class="text-primary font-bold">giao dịch trung gian</span> hoặc <span class="text-primary font-bold">giao dịch trực tiếp</span>. Đảm bảo quyền lợi khách hàng là ưu tiên số 1.
                        </p>
                    </div>
                </div>
                <div class="corner-accents"></div>
            </div>

            <!-- Support Policy -->
            <div class="techno-card group">
                <div class="card-glow"></div>
                <div class="relative z-10 flex gap-6">
                    <div class="techno-icon-box">
                        <span class="material-icons text-3xl">support_agent</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary animate-ping rounded-full"></span>
                            HỖ TRỢ 24/7
                        </h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Mọi vấn đề thắc mắc quý khách vui lòng liên hệ <span class="text-primary font-bold">Hỗ Trợ Khách Hàng</span>. Chúng tôi luôn sẵn sàng giải đáp và xử lý nhanh chóng.
                        </p>
                    </div>
                </div>
                <div class="corner-accents"></div>
            </div>
        </div>

        <!-- Community Section -->
        <div class="techno-section mb-16 border-l-4 border-primary bg-primary/5 p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <span class="material-icons text-8xl">hub</span>
            </div>
            <div class="relative z-10">
                <h2 class="text-2xl font-black text-white mb-6 uppercase tracking-widest italic">
                    Kế nối cộng đồng <span class="text-primary">Vanh69</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="https://zalo.me/g/wilgna867" target="_blank" class="social-btn zalo">
                        <div class="btn-inner">
                            <span class="font-bold text-sm">ZALO GROUP</span>
                            <span class="text-[10px] opacity-70">Nhận quà & Event</span>
                        </div>
                    </a>
                    <a href="https://discord.gg/akqCugS2" target="_blank" class="social-btn discord">
                        <div class="btn-inner">
                            <span class="font-bold text-sm">DISCORD SERVER</span>
                            <span class="text-[10px] opacity-70">Giao lưu cộng đồng</span>
                        </div>
                    </a>
                    <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="social-btn facebook">
                        <div class="btn-inner">
                            <span class="font-bold text-sm">ADMIN FACEBOOK</span>
                            <span class="text-[10px] opacity-70">Liên hệ trực tiếp</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Closing Note -->
        <div class="text-center max-w-3xl mx-auto border border-primary/20 bg-black/40 backdrop-blur-md p-10 rounded-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent"></div>

            <span class="material-icons text-primary text-5xl mb-6 animate-bounce">favorite</span>
            <h2 class="text-2xl font-black text-white mb-4 italic uppercase">LỜI CẢM ƠN</h2>
            <p class="text-slate-400 mb-8 italic">
                "Cảm ơn tất cả anh em đã đồng hành cùng shop trong suốt thời gian qua. Trong thời gian tới, ban quản trị sẽ hoàn thiện sớm nhất các chức năng mới, mong chúng ta cùng xây dựng cộng đồng lành mạnh, vui vẻ và phát triển cùng FCO."
            </p>

            <div class="inline-flex items-center gap-4 text-xs font-bold tracking-widest text-primary/70">
                <span class="w-12 h-px bg-primary/30"></span>
                SYSTEM STABILIZED
                <span class="w-12 h-px bg-primary/30"></span>
            </div>
        </div>
    </div>
</div>

<style>
    .techno-card {
        background: rgba(0, 26, 15, 0.4);
        border: 1px solid rgba(0, 255, 0, 0.1);
        border-right: 4px solid rgba(0, 255, 0, 0.2);
        padding: 40px 30px;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .techno-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: #00ff00;
        box-shadow: 0 0 30px rgba(0, 255, 0, 0.15);
        background: rgba(0, 26, 15, 0.6);
    }

    .card-glow {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 0, 0.05), transparent);
        transition: 0.5s;
    }

    .techno-card:hover .card-glow {
        left: 100%;
    }

    .techno-icon-box {
        width: 60px;
        height: 60px;
        min-width: 60px;
        background: rgba(0, 255, 0, 0.1);
        border: 1px solid #00ff00;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #00ff00;
        transform: rotate(45deg);
        box-shadow: 0 0 15px rgba(0, 255, 0, 0.3);
        transition: 0.3s;
    }

    .techno-card:hover .techno-icon-box {
        background: #00ff00;
        color: #000;
        transform: rotate(45deg) scale(1.1);
    }

    .techno-icon-box span {
        transform: rotate(-45deg);
    }

    .corner-accents::before,
    .corner-accents::after {
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        border: 2px solid #00ff00;
        opacity: 0.3;
        transition: 0.3s;
    }

    .corner-accents::before {
        top: 10px;
        left: 10px;
        border-right: 0;
        border-bottom: 0;
    }

    .corner-accents::after {
        bottom: 10px;
        right: 10px;
        border-left: 0;
        border-top: 0;
    }

    .techno-card:hover .corner-accents::before,
    .techno-card:hover .corner-accents::after {
        opacity: 1;
        width: 25px;
        height: 25px;
    }

    /* Social Buttons */
    .social-btn {
        display: block;
        padding: 2px;
        background: rgba(255, 255, 255, 0.1);
        position: relative;
        text-decoration: none;
        transition: 0.3s;
        transform: skewX(-12deg);
    }

    .btn-inner {
        background: #000;
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #fff;
        transition: 0.3s;
    }

    .social-btn:hover .btn-inner {
        background: #00ff00;
        color: #000;
    }

    .social-btn.zalo {
        border: 1px solid #0068ff;
    }

    .social-btn.discord {
        border: 1px solid #5865f2;
    }

    .social-btn.facebook {
        border: 1px solid #1877f2;
    }

    .zalo:hover {
        box-shadow: 0 0 20px rgba(0, 104, 255, 0.4);
    }

    .discord:hover {
        box-shadow: 0 0 20px rgba(88, 101, 242, 0.4);
    }

    .facebook:hover {
        box-shadow: 0 0 20px rgba(24, 119, 242, 0.4);
    }

    /* Animations */
    @keyframes scan-slow {
        0% {
            transform: translateY(-100%);
        }

        100% {
            transform: translateY(100vh);
        }
    }

    .animate-scan-slow {
        animation: scan-slow 8s linear infinite;
    }

    @media (max-width: 768px) {
        .techno-card {
            padding: 30px 20px;
        }

        .techno-icon-box {
            width: 50px;
            height: 50px;
            min-width: 50px;
        }
    }
</style>
@endsection