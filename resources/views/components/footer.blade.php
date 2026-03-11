<footer class="relative mt-16 pt-16 pb-8 bg-bg-dark border-t border-border">
    <!-- Decorative background glow -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary/5 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="container mx-auto px-2 md:px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- About -->
            <div>
                <div class="flex items-center gap-2 mb-8">
                    <span class="text-2xl md:text-4xl font-black italic tracking-tighter text-white drop-shadow-[0_0_15px_rgba(74,222,128,0.3)]">
                        VANH<span class="text-primary">FCO</span>
                    </span>
                </div>
                <p class="text-text-secondary text-sm leading-relaxed max-w-sm">
                    Hệ thống mua bán nick FC Online uy tín, an toàn nhất Việt Nam. Giao dịch tự động 24/7, hỗ trợ nhiệt tình, bảo mật tuyệt đối.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="font-black text-sm mb-6 text-white uppercase tracking-[0.2em] flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary rounded-full"></span>
                    LIÊN KẾT NHANH
                </h5>
                <ul class="space-y-3 text-sm text-text-secondary">
                    <li><a class="hover:text-white transition-colors flex items-center gap-2 group" href="{{ route('home') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Trang chủ
                        </a></li>
                    <li><a class="hover:text-white transition-colors flex items-center gap-2 group" href="{{ route('products.index') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Sản phẩm
                        </a></li>
                    <li><a class="hover:text-white transition-colors flex items-center gap-2 group" href="{{ route('deposit') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Hướng dẫn nạp tiền
                        </a></li>
                    <li><a class="hover:text-white transition-colors flex items-center gap-2 group" href="{{ route('news.index') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Tin tức
                        </a></li>
                    <li><a class="hover:text-white transition-colors flex items-center gap-2 group" href="{{ route('policy') }}">
                            <span class="material-icons text-xs group-hover:translate-x-1 transition-transform">chevron_right</span>
                            Chính sách & Quy định
                        </a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h5 class="font-black text-sm mb-6 text-white uppercase tracking-[0.2em] flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary rounded-full"></span>
                    HỖ TRỢ KHÁCH HÀNG
                </h5>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center border border-white/10 group-hover:border-primary/50 transition-colors">
                            <span class="material-icons text-primary">phone</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-neutral-600 uppercase tracking-widest font-black">Hotline</p>
                            <p class="text-sm font-bold text-white group-hover:text-primary transition-colors">0986.526.036</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center border border-white/10 group-hover:border-primary/50 transition-colors">
                            <span class="material-icons text-primary">schedule</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-neutral-600 uppercase tracking-widest font-black">Giờ làm việc</p>
                            <p class="text-sm font-bold text-white">08:00AM - 22:00PM</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h5 class="font-black text-sm mb-6 text-white uppercase tracking-[0.2em] flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary rounded-full"></span>
                    THEO DÕI CHÚNG TÔI
                </h5>
                <div class="flex gap-4">
                    <a class="w-12 h-12 bg-white/5 hover:bg-primary border border-white/10 text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-lg" href="https://www.facebook.com/le.vietanh.939173" aria-label="Facebook">
                        <span class="material-icons">facebook</span>
                    </a>
                    <a class="w-12 h-12 bg-white/5 hover:bg-primary border border-white/10 text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-lg" href="https://www.tiktok.com/@lee.vanhh" aria-label="Tiktok">
                        <span class="material-icons text-xl">tiktok</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center border-t border-white/5 pt-8">
            <p class="text-text-muted text-[10px] font-black uppercase tracking-widest md:tracking-[0.3em] px-4 leading-loose">
                Copyright © {{ date('Y') }} <span class="text-primary/70">VanhFCO.com</span> <br class="md:hidden"> - <a href="https://www.facebook.com/truong.cut.5220" class="hover:text-text-primary transition-colors">Truonghocdot</a>
            </p>
        </div>
    </div>
</footer>