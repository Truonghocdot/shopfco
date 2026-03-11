@extends('layouts.app')

@section('title', 'Chính Sách - AccFCO | VanhFCO - Mua Acc FC Online Uy Tín')
@section('description', 'Chính sách mua bán Acc chứa FC, Acc Mở thẻ, Acc đội hình tại VanhFCO. Hoa hồng 5% cho người giới thiệu. Bảo mật thông tin, đổi trả linh hoạt, thanh toán an toàn.')

@push('meta')
<meta name="keywords" content="AccFCO, VanhFCO, Acc chứa FC, Acc Mở thẻ, Acc chứa BP trắng, Acc đội hình, mua acc FC Online, shop acc FC Online">
<meta property="og:title" content="Chính Sách - AccFCO | VanhFCO">
<meta property="og:description" content="Chính sách mua bán Acc chứa FC, Acc Mở thẻ, Acc đội hình. Hoa hồng 5% cho người giới thiệu.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/policy') }}">
<meta name="twitter:card" content="summary">
<link rel="canonical" href="{{ url('/policy') }}">
@endpush


@push('schema')
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "VanhFCO - AccFCO",
        "alternateName": ["VanhFCO", "AccFCO"],
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "Shop bán Acc chứa FC, Acc Mở thẻ, Acc đội hình FC Online uy tín",
        "sameAs": [
            "https://www.facebook.com/le.vietanh.939173"
        ]
    }
</script>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "FAQPage",
        "mainEntity": [{
                "@@type": "Question",
                "name": "Chính sách hoa hồng giới thiệu tại VanhFCO như thế nào?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Khi giới thiệu bạn bè mua Acc chứa FC, Acc Mở thẻ hoặc Acc đội hình tại VanhFCO, bạn sẽ nhận được 5% hoa hồng từ mỗi đơn hàng thành công."
                }
            },
            {
                "@@type": "Question",
                "name": "VanhFCO có bán những loại acc gì?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "VanhFCO chuyên cung cấp Acc chứa FC, Acc Mở thẻ, Acc chứa BP trắng, Acc đội hình và nhiều loại tài khoản FC Online khác."
                }
            },
            {
                "@@type": "Question",
                "name": "Chính sách đổi trả AccFCO ra sao?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "AccFCO cam kết đổi trả trong 24h nếu tài khoản không đúng mô tả. Áp dụng cho tất cả Acc chứa FC, Acc Mở thẻ và Acc đội hình."
                }
            },
            {
                "@@type": "Question",
                "name": "Làm thế nào để mua Acc chứa FC tại VanhFCO?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Đăng ký tài khoản tại VanhFCO, nạp tiền vào ví, chọn Acc chứa FC hoặc Acc Mở thẻ phù hợp, sau đó thanh toán. Tài khoản sẽ được giao ngay lập tức."
                }
            }
        ]
    }
</script>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "BreadcrumbList",
        "itemListElement": [{
                "@@type": "ListItem",
                "position": 1,
                "name": "Trang chủ",
                "item": "{{ url('/') }}"
            },
            {
                "@@type": "ListItem",
                "position": 2,
                "name": "Chính sách",
                "item": "{{ url('/policy') }}"
            }
        ]
    }
</script>
@endpush

@section('content')
<div class="policy-page relative overflow-hidden min-h-screen pt-12 pb-20">
    <div class="container mx-auto px-4 relative z-10 max-w-6xl">
        <!-- Hero Section -->
        <div class="text-center mb-16 relative scroll-reveal">
            <div class="inline-block relative mb-6">
                <div class="relative bg-linear-to-r from-primary to-indigo-600 text-white px-12 py-5 font-black text-3xl md:text-6xl rounded-3xl shadow-[0_0_30px_rgba(74,222,128,0.3)] transform hover:scale-105 transition-all">
                    CHÍNH SÁCH & QUY ĐỊNH
                </div>
            </div>
            <p class="text-white font-black tracking-[0.3em] uppercase text-xs md:text-sm mt-4 opacity-80">
                VanhFCO - AccFCO Security & Support System Protocol v2.0
            </p>
        </div>

        <!-- Main Content -->
        <div class="space-y-12">
            <!-- 1. Affiliate Commission Policy -->
            <section class="policy-section scroll-reveal">
                <h2 class="section-title text-white">
                    <span class="material-icons text-primary drop-shadow-[0_0_8px_rgba(74,222,128,0.5)]">card_giftcard</span>
                    1. Chính Sách Hoa Hồng Giới Thiệu
                </h2>

                <div class="content-box glass space-y-6 border-white/10">
                    <div>
                        <h3 class="subsection-title text-white">1.1 Giới thiệu chương trình</h3>
                        <p class="text-neutral-400 leading-relaxed">
                            Chương trình hoa hồng giới thiệu tại <strong class="text-primary font-black uppercase">VanhFCO</strong> được thiết kế để tri ân khách hàng thân thiết.
                            Khi bạn giới thiệu bạn bè mua <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong>,
                            <strong class="text-primary">Acc chứa BP trắng</strong> hoặc <strong class="text-primary">Acc đội hình</strong>,
                            bạn sẽ nhận được <span class="text-primary font-black underline decoration-primary/30 underline-offset-4">5% hoa hồng</span> từ mỗi đơn hàng thành công.
                        </p>
                    </div>

                    <div>
                        <h3 class="subsection-title text-white">1.2 Cách thức hoạt động</h3>
                        <ol class="list-decimal list-inside space-y-3 text-neutral-400 leading-relaxed">
                            <li>Đăng ký tài khoản tại <strong class="text-primary">AccFCO</strong></li>
                            <li>Truy cập <a href="{{ route('user.profile') }}" class="text-primary hover:text-white transition-colors underline decoration-primary/30 underline-offset-4">trang cá nhân</a> để lấy link giới thiệu riêng</li>
                            <li>Chia sẻ link với bạn bè, người thân</li>
                            <li>Khi họ đăng ký và mua <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong> hoặc <strong class="text-primary">Acc đội hình</strong>, bạn nhận 5% hoa hồng</li>
                            <li>Hoa hồng tự động cộng vào ví, có thể sử dụng ngay để mua <strong class="text-primary">Acc chứa BP trắng</strong> hoặc các sản phẩm khác</li>
                        </ol>
                    </div>

                    <div>
                        <h3 class="subsection-title text-white">1.3 Điều kiện tham gia</h3>
                        <ul class="list-disc list-inside space-y-3 text-neutral-400 leading-relaxed">
                            <li>Tài khoản đã đăng ký tại <strong class="text-primary">VanhFCO</strong></li>
                            <li>Không được tự giới thiệu chính mình</li>
                            <li>Tuân thủ các quy định sử dụng dịch vụ</li>
                            <li>Người được giới thiệu phải hoàn tất đơn hàng thành công</li>
                        </ul>
                    </div>

                    <div class="bg-primary/5 border border-primary/20 rounded-2xl p-6">
                        <p class="text-primary font-black mb-3 flex items-center gap-2 uppercase text-[10px] tracking-widest">
                            <span class="material-icons text-sm">lightbulb</span>
                            Lưu ý quan trọng
                        </p>
                        <p class="text-neutral-400 text-sm leading-relaxed">
                            Hoa hồng được tính trên tổng giá trị đơn hàng sau khi áp dụng giảm giá.
                            Bạn có thể theo dõi thu nhập từ giới thiệu và số lượng người đã giới thiệu trong trang cá nhân.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 2. Privacy Policy -->
            <section class="policy-section">
                <h2 class="section-title">
                    <span class="material-icons">shield</span>
                    2. Chính Sách Bảo Mật Thông Tin
                </h2>

                <div class="content-box space-y-6">
                    <div>
                        <h3 class="subsection-title">2.1 Thu thập thông tin</h3>
                        <p class="text-gray-600 leading-relaxed">
                            <strong class="text-primary">VanhFCO</strong> cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng khi mua
                            <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong> hoặc
                            <strong class="text-primary">Acc đội hình</strong>. Chúng tôi chỉ thu thập thông tin cần thiết cho giao dịch.
                        </p>
                    </div>

                    <div>
                        <h3 class="subsection-title">2.2 Sử dụng thông tin</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-600 leading-relaxed">
                            <li>Xác thực giao dịch mua <strong class="text-primary">AccFCO</strong></li>
                            <li>Hỗ trợ khách hàng khi có vấn đề</li>
                            <li>Gửi thông báo về đơn hàng và chương trình khuyến mãi</li>
                            <li>Bảo vệ quyền lợi khách hàng</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="subsection-title">2.3 Cam kết bảo mật</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Thông tin khách hàng tại <strong class="text-primary">AccFCO</strong> được mã hóa và lưu trữ an toàn.
                            Chúng tôi không chia sẻ thông tin với bên thứ ba khi chưa có sự đồng ý.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 3. Purchase Policy -->
            <section class="policy-section">
                <h2 class="section-title">
                    <span class="material-icons">shopping_cart</span>
                    3. Chính Sách Mua Bán Acc FC Online
                </h2>

                <div class="content-box space-y-6">
                    <div>
                        <h3 class="subsection-title">3.1 Quy trình mua Acc chứa FC</h3>
                        <ol class="list-decimal list-inside space-y-2 text-gray-600 leading-relaxed">
                            <li>Đăng ký/Đăng nhập tài khoản tại <strong class="text-primary">VanhFCO</strong></li>
                            <li>Nạp tiền vào ví qua chuyển khoản ngân hàng</li>
                            <li>Chọn <a href="{{ route('products.index') }}" class="text-primary hover:underline">Acc chứa FC</a> phù hợp với nhu cầu</li>
                            <li>Thanh toán và nhận tài khoản ngay lập tức</li>
                        </ol>
                    </div>

                    <div>
                        <h3 class="subsection-title">3.2 Quy trình mua Acc Mở thẻ</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Tương tự như mua <strong class="text-primary">Acc chứa FC</strong>, khách hàng chọn
                            <strong class="text-primary">Acc Mở thẻ</strong> theo số lượng thẻ mong muốn, thanh toán và nhận tài khoản.
                        </p>
                    </div>

                    <div>
                        <h3 class="subsection-title text-white">3.3 Quy trình mua Acc đội hình</h3>
                        <p class="text-neutral-400 leading-relaxed">
                            <strong class="text-primary">Acc đội hình</strong> được phân loại theo chất lượng cầu thủ và tổng OVR.
                            Khách hàng có thể xem chi tiết đội hình trước khi mua tại <strong class="text-primary">VanhFCO</strong>.
                        </p>
                    </div>

                    <div class="bg-primary/5 border border-primary/20 rounded-2xl p-6">
                        <p class="text-primary font-black mb-2 uppercase text-[10px] tracking-widest">✓ Cam kết chất lượng</p>
                        <p class="text-neutral-400 text-sm leading-relaxed">
                            Tất cả <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong>,
                            <strong class="text-primary">Acc chứa BP trắng</strong> và <strong class="text-primary">Acc đội hình</strong>
                            tại <strong class="text-primary">AccFCO</strong> đều được kiểm tra kỹ lưỡng trước khi bán.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 4. Return Policy -->
            <section class="policy-section">
                <h2 class="section-title">
                    <span class="material-icons">sync</span>
                    4. Chính Sách Đổi Trả
                </h2>

                <div class="content-box space-y-6">
                    <div>
                        <h3 class="subsection-title">4.1 Điều kiện đổi trả</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            <strong class="text-primary">VanhFCO</strong> chấp nhận đổi trả trong các trường hợp sau:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-gray-600 leading-relaxed">
                            <li><strong class="text-primary">Acc chứa FC</strong> không đúng số lượng FC đã mô tả</li>
                            <li><strong class="text-primary">Acc Mở thẻ</strong> không đúng số lượng thẻ</li>
                            <li><strong class="text-primary">Acc đội hình</strong> thiếu cầu thủ hoặc sai OVR</li>
                            <li>Tài khoản bị khóa do lỗi từ phía shop</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="subsection-title">4.2 Thời gian đổi trả</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Khách hàng cần thông báo trong vòng <span class="highlight-text">24 giờ</span> kể từ khi nhận tài khoản.
                            <strong class="text-primary">AccFCO</strong> sẽ xử lý đổi trả trong vòng 24-48 giờ.
                        </p>
                    </div>

                    <div>
                        <h3 class="subsection-title">4.3 Quy trình đổi trả</h3>
                        <ol class="list-decimal list-inside space-y-2 text-gray-600 leading-relaxed">
                            <li>Liên hệ bộ phận hỗ trợ qua Zalo/Facebook</li>
                            <li>Cung cấp thông tin đơn hàng và vấn đề gặp phải</li>
                            <li>Chờ xác nhận từ <strong class="text-primary">VanhFCO</strong></li>
                            <li>Nhận tài khoản mới hoặc hoàn tiền vào ví</li>
                        </ol>
                    </div>
                </div>
            </section>

            <!-- 5. Payment Policy -->
            <section class="policy-section">
                <h2 class="section-title">
                    <span class="material-icons">payment</span>
                    5. Chính Sách Thanh Toán
                </h2>

                <div class="content-box space-y-6">
                    <div>
                        <h3 class="subsection-title">5.1 Phương thức thanh toán</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Khi mua <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong>
                            hoặc <strong class="text-primary">Acc đội hình</strong> tại <strong class="text-primary">VanhFCO</strong>,
                            khách hàng thanh toán qua:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-gray-600 leading-relaxed">
                            <li>Chuyển khoản ngân hàng (tự động cộng tiền)</li>
                            <li>Ví điện tử (đang phát triển)</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="subsection-title">5.2 Bảo mật thanh toán</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Mọi giao dịch tại <strong class="text-primary">AccFCO</strong> được mã hóa và bảo mật.
                            Thông tin thanh toán không được lưu trữ sau khi giao dịch hoàn tất.
                        </p>
                    </div>

                    <div>
                        <h3 class="subsection-title">5.3 Hoàn tiền</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Trong trường hợp đổi trả, tiền sẽ được hoàn vào ví tại <strong class="text-primary">VanhFCO</strong>
                            để khách hàng có thể mua <strong class="text-primary">Acc chứa FC</strong> hoặc sản phẩm khác.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Quick Policy Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16">
                <!-- OTP Policy -->
                <div class="policy-card group">
                    <div class="flex gap-6">
                        <div class="policy-icon-box">
                            <span class="material-icons text-3xl">vpn_key</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-white mb-3 flex items-center gap-2 uppercase tracking-widest leading-tight">
                                BẢO MẬT OTP
                            </h3>
                            <p class="text-neutral-600 leading-relaxed text-xs font-bold">
                                Đối với <strong class="text-primary">Acc chứa FC</strong> có SĐT, quý khách liên hệ shop để lấy mã OTP.
                                <strong class="text-primary">VanhFCO</strong> bảo lưu và bảo hành bảo mật tuyệt đối.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Guarantee Policy -->
                <div class="policy-card group">
                    <div class="flex gap-6">
                        <div class="policy-icon-box">
                            <span class="material-icons text-3xl">verified_user</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-800 mb-3 flex items-center gap-2">
                                CHẤT LƯỢNG NICK
                            </h3>
                            <p class="text-gray-500 leading-relaxed text-sm">
                                <strong class="text-primary">Acc Mở thẻ</strong>, <strong class="text-primary">Acc đội hình</strong>
                                sạch 100%, không tranh chấp. <strong class="text-primary">AccFCO</strong> cam kết BẢO HÀNH TRỌN ĐỜI.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Transaction Policy -->
                <div class="policy-card group">
                    <div class="flex gap-6">
                        <div class="policy-icon-box">
                            <span class="material-icons text-3xl">handshake</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-800 mb-3 flex items-center gap-2">
                                HỖ TRỢ GIAO DỊCH
                            </h3>
                            <p class="text-gray-500 leading-relaxed text-sm">
                                Sẵn sàng hỗ trợ giao dịch trung gian hoặc trực tiếp khi mua
                                <strong class="text-primary">Acc chứa BP trắng</strong>. Đảm bảo quyền lợi khách hàng.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Support Policy -->
                <div class="policy-card group">
                    <div class="flex gap-6">
                        <div class="policy-icon-box">
                            <span class="material-icons text-3xl">support_agent</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-800 mb-3 flex items-center gap-2">
                                HỖ TRỢ 24/7
                            </h3>
                            <p class="text-gray-500 leading-relaxed text-sm">
                                Mọi vấn đề về <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong>
                                vui lòng liên hệ Hỗ Trợ Khách Hàng. Xử lý nhanh chóng.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Community Section -->
            <div class="glass rounded-3xl border border-white/10 shadow-3xl p-8 relative overflow-hidden mt-16">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <span class="material-icons text-8xl text-primary">hub</span>
                </div>
                <div class="relative z-10">
                    <h2 class="text-2xl font-black text-white mb-6 uppercase tracking-widest">
                        Kết nối cộng đồng <span class="text-primary">VanhFCO</span>
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
            <div class="text-center max-w-4xl mx-auto bg-neutral-950/50 border border-white/10 backdrop-blur-3xl p-12 rounded-[2.5rem] relative overflow-hidden mt-20 group/thanks shadow-3xl">
                <!-- Removed Tet flowers -->

                <div class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-transparent via-primary to-transparent"></div>

                <div class="relative z-10">
                    <span class="material-icons text-primary text-6xl mb-6 animate-bounce">favorite</span>
                    <h2 class="text-3xl font-black text-gray-800 mb-6 uppercase tracking-widest">LỜI CẢM ƠN CHÂN THÀNH</h2>
                    <div class="max-w-2xl mx-auto">
                        <p class="text-gray-600 mb-8 italic text-lg leading-relaxed">
                            "Cảm ơn tất cả anh em đã tin tưởng <strong class="text-primary underline decoration-2 underline-offset-4">VanhFCO</strong> - <strong class="text-primary underline decoration-2 underline-offset-4">AccFCO</strong>
                            để mua <strong class="text-primary">Acc chứa FC</strong>, <strong class="text-primary">Acc Mở thẻ</strong>,
                            <strong class="text-primary">Acc đội hình</strong>. Chúng tôi cam kết mang đến dịch vụ tốt nhất cho cộng đồng FC Online."
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-6 text-xs font-black tracking-[0.4em] text-primary uppercase">
                        <span class="w-16 h-0.5 bg-linear-to-r from-transparent to-primary/30"></span>
                        VanhFCO PROTOCOL
                        <span class="w-16 h-0.5 bg-linear-to-l from-transparent to-primary/30"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .policy-section {
        margin-bottom: 4rem;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 950;
        color: #fff;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .section-title .material-icons {
        font-size: 2.25rem;
    }

    .subsection-title {
        font-size: 1.25rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .content-box {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-left: 4px solid #4ade80;
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .policy-card {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 2rem;
        padding: 40px 30px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .policy-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(74, 222, 128, 0.15);
        border-color: rgba(74, 222, 128, 0.4);
    }

    .policy-icon-box {
        width: 64px;
        height: 64px;
        min-width: 64px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4ade80;
        transition: 0.4s;
    }

    .policy-card:hover .policy-icon-box {
        background: #4ade80;
        color: #fff;
        border-color: #4ade80;
        box-shadow: 0 0 20px rgba(74, 222, 128, 0.4);
    }

    /* Social Buttons */
    .social-btn {
        display: block;
        border-radius: 0.75rem;
        overflow: hidden;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-inner {
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: 0.3s;
    }

    .social-btn.zalo {
        background: #0068ff;
        color: #fff;
    }

    .social-btn.discord {
        background: #5865f2;
        color: #fff;
    }

    .social-btn.facebook {
        background: #1877f2;
        color: #fff;
    }

    .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .policy-card {
            padding: 30px 20px;
        }

        .policy-icon-box {
            width: 50px;
            height: 50px;
            min-width: 50px;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .content-box {
            padding: 1.5rem;
        }
    }
</style>
@endsection