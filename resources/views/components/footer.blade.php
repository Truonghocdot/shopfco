<footer class="mt-20 border-t border-gray-200 bg-gray-50 pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- About -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="bg-primary text-black px-3 py-1 font-black text-xl italic rounded transform -skew-x-12">VanhFCO</div>
                    <span class="font-bold text-lg text-gray-800">.COM</span>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Hệ thống mua bán nick FC Online uy tín, an toàn nhất Việt Nam. Giao dịch tự động 24/7, hỗ trợ nhiệt tình, bảo mật tuyệt đối.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="font-bold text-lg mb-6 text-primary-dark" style="color: #00a152;">LIÊN KẾT NHANH</h5>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li><a class="hover:text-primary-dark transition" href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a class="hover:text-primary-dark transition" href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li><a class="hover:text-primary-dark transition" href="{{ route('deposit') }}">Hướng dẫn nạp tiền</a></li>
                    <li><a class="hover:text-primary-dark transition" href="{{ route('news.index') }}">Tin tức</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h5 class="font-bold text-lg mb-6 text-primary-dark" style="color: #00a152;">HỖ TRỢ KHÁCH HÀNG</h5>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-primary">phone</span>
                        <div>
                            <p class="text-xs text-gray-500">Hotline</p>
                            <p class="text-sm font-bold text-gray-800">0986.526.036</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-primary">schedule</span>
                        <div>
                            <p class="text-xs text-gray-500">Giờ làm việc</p>
                            <p class="text-sm font-bold text-gray-800">08:00AM - 22:00PM</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h5 class="font-bold text-lg mb-6 text-primary-dark" style="color: #00a152;">THEO DÕI CHÚNG TÔI</h5>
                <div class="flex gap-4">
                    <a class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full transition" href="https://www.facebook.com/le.vietanh.939173" aria-label="Facebook">
                        <span class="material-icons">facebook</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center border-t border-gray-200 pt-6">
            <p class="text-gray-500 text-xs italic">
                Copyright © {{ date('Y') }} VanhFCO.com - Powered by Gamers for Gamers
            </p>
        </div>
    </div>
</footer>