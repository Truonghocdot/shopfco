<footer class="relative mt-20 border-t-2 border-primary/20 bg-gradient-to-b from-black via-[#001a0f] to-black pt-12 pb-6 overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px);"></div>
    </div>

    <!-- Scan Line Animation -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute w-full h-[2px] bg-gradient-to-r from-transparent via-primary to-transparent opacity-30 animate-scan-vertical"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- About - Techno Style -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="bg-gradient-to-r from-primary to-green-400 text-black px-3 py-1 font-black text-xl italic rounded transform -skew-x-12 shadow-[0_0_15px_rgba(0,255,0,0.5)]">VanhFCO</div>
                    <span class="font-black text-lg text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">.COM</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Hệ thống mua bán nick FC Online uy tín, an toàn nhất Việt Nam. Giao dịch tự động 24/7, hỗ trợ nhiệt tình, bảo mật tuyệt đối.
                </p>
            </div>

            <!-- Quick Links - Techno Style -->
            <div>
                <h5 class="font-black text-lg mb-6 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">LIÊN KẾT NHANH</h5>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a class="hover:text-primary transition-colors flex items-center gap-2 group" href="{{ route('home') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Trang chủ
                        </a></li>
                    <li><a class="hover:text-primary transition-colors flex items-center gap-2 group" href="{{ route('products.index') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Sản phẩm
                        </a></li>
                    <li><a class="hover:text-primary transition-colors flex items-center gap-2 group" href="{{ route('deposit') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Hướng dẫn nạp tiền
                        </a></li>
                    <li><a class="hover:text-primary transition-colors flex items-center gap-2 group" href="{{ route('news.index') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Tin tức
                        </a></li>
                    <li><a class="hover:text-primary transition-colors flex items-center gap-2 group" href="{{ route('policy') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Chính sách & Quy định
                        </a></li>
                </ul>
            </div>

            <!-- Support - Techno Style -->
            <div>
                <h5 class="font-black text-lg mb-6 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">HỖ TRỢ KHÁCH HÀNG</h5>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 group">
                        <span class="material-icons text-primary group-hover:scale-110 transition-transform">phone</span>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wide">Hotline</p>
                            <p class="text-sm font-black text-white">0986.526.036</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <span class="material-icons text-primary group-hover:scale-110 transition-transform">schedule</span>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wide">Giờ làm việc</p>
                            <p class="text-sm font-black text-white">08:00AM - 22:00PM</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Social - Techno Style -->
            <div>
                <h5 class="font-black text-lg mb-6 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">THEO DÕI CHÚNG TÔI</h5>
                <div class="flex gap-4">
                    <a class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-all hover:scale-110 shadow-[0_0_15px_rgba(37,99,235,0.5)] hover:shadow-[0_0_25px_rgba(37,99,235,0.7)] border-2 border-blue-400" href="https://www.facebook.com/le.vietanh.939173" aria-label="Facebook">
                        <span class="material-icons">facebook</span>
                    </a>
                    <a class="bg-black hover:bg-black/80 text-white p-3 rounded-full transition-all hover:scale-110 shadow-[0_0_15px_rgba(37,99,235,0.5)] hover:shadow-[0_0_25px_rgba(37,99,235,0.7)] border-2 border-blue-400" href="https://www.tiktok.com/@lee.vanhh" aria-label="Tiktok">
                        <span class="material-icons">tiktok</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center border-t-2 border-primary/20 pt-6">
            <p class="text-slate-500 text-xs italic font-bold">
                Copyright © {{ date('Y') }} <span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">VanhFCO.com</span> - <a href="https://www.facebook.com/truong.cut.5220" class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)] hover:text-primary transition-colors">Truonghocdot</a>
            </p>
        </div>
    </div>
</footer>