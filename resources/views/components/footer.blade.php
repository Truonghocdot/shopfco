<footer class="relative mt-16 pt-12 pb-6" style="background: linear-gradient(135deg, #8B1515 0%, #A01C1C 50%, #8B1515 100%);">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- About -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <img src="{{ asset('logo.webp') }}" alt="Logo" class="h-16" width="128" height="128" />
                </div>
                <p class="text-white/70 text-sm leading-relaxed">
                    Hệ thống mua bán nick FC Online uy tín, an toàn nhất Việt Nam. Giao dịch tự động 24/7, hỗ trợ nhiệt tình, bảo mật tuyệt đối.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="font-black text-lg mb-6 text-yellow-300 uppercase tracking-wide">LIÊN KẾT NHANH</h5>
                <ul class="space-y-3 text-sm text-white/70">
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
                <h5 class="font-black text-lg mb-6 text-yellow-300 uppercase tracking-wide">HỖ TRỢ KHÁCH HÀNG</h5>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-yellow-300">phone</span>
                        <div>
                            <p class="text-xs text-white/50 uppercase tracking-wide">Hotline</p>
                            <p class="text-sm font-black text-white">0986.526.036</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-yellow-300">schedule</span>
                        <div>
                            <p class="text-xs text-white/50 uppercase tracking-wide">Giờ làm việc</p>
                            <p class="text-sm font-black text-white">08:00AM - 22:00PM</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h5 class="font-black text-lg mb-6 text-yellow-300 uppercase tracking-wide">THEO DÕI CHÚNG TÔI</h5>
                <div class="flex gap-4">
                    <a class="bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all hover:scale-110" href="https://www.facebook.com/le.vietanh.939173" aria-label="Facebook">
                        <span class="material-icons">facebook</span>
                    </a>
                    <a class="bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all hover:scale-110" href="https://www.tiktok.com/@lee.vanhh" aria-label="Tiktok">
                        <span class="material-icons">tiktok</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center border-t border-white/20 pt-6">
            <p class="text-white/60 text-xs italic font-bold">
                Copyright © {{ date('Y') }} <span class="text-yellow-300">VanhFCO.com</span> - <a href="https://www.facebook.com/truong.cut.5220" class="text-yellow-300 hover:text-white transition-colors">Truonghocdot</a>
            </p>
        </div>
    </div>
</footer>