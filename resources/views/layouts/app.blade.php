<!DOCTYPE html>
<html lang="vi" class="overflow-x-hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'AccFCO - VanhFCO | Mua Acc chứa FC, Acc Mở thẻ, Acc đội hình Uy Tín')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'VanhFCO - AccFCO chuyên bán Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng FC Online uy tín. Giá rẻ, giao dịch tự động 24/7, hoa hồng 5% cho người giới thiệu.')">
    <meta name="keywords" content="@yield('keywords', 'AccFCO, VanhFCO, Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng, mua acc FC Online, shop acc FCO')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Open Graph & Twitter Card -->
    <meta property="og:title" content="@yield('title', 'AccFCO - VanhFCO | Mua Acc chứa FC, Acc Mở thẻ, Acc đội hình Uy Tín')">
    <meta property="og:description" content="@yield('description', 'VanhFCO - AccFCO chuyên bán Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng FC Online uy tín. Giá rẻ, giao dịch tự động 24/7, hoa hồng 5% cho người giới thiệu.')">
    <meta property="og:type" content="@yield('og:type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.png'))">
    <meta property="og:site_name" content="VanhFCO - AccFCO">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'AccFCO - VanhFCO | Mua Acc chứa FC, Acc Mở thẻ, Acc đội hình Uy Tín')">
    <meta name="twitter:description" content="@yield('description', 'VanhFCO - AccFCO chuyên bán Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng FC Online uy tín. Giá rẻ, giao dịch tự động 24/7, hoa hồng 5% cho người giới thiệu.')">
    <meta name="twitter:image" content="@yield('og:image', asset('images/og-image.png'))">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&family=Lexend:wght@300;400;500;600;700&family=Spline+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')

    <!-- Additional Meta Tags -->
    @stack('meta')

    <!-- Global Organization Schema -->
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Organization",
            "name": "VanhFCO - AccFCO",
            "alternateName": ["VanhFCO", "AccFCO"],
            "url": "{{ url('/') }}",
            "logo": "{{ asset('images/logo.png') }}",
            "description": "Shop bán Acc chứa FC, Acc Mở thẻ, Acc đội hình FC Online uy tín nhất Việt Nam",
            "contactPoint": {
                "@@type": "ContactPoint",
                "telephone": "+84986526036",
                "contactType": "Customer Service",
                "availableLanguage": "Vietnamese"
            },
            "sameAs": [
                "https://www.facebook.com/le.vietanh.939173",
                "https://zalo.me/g/wilgna867"
            ]
        }
    </script>

    @stack('schema')
</head>

<body class="min-h-screen text-text-primary selection:bg-primary/30 selection:text-white overflow-x-hidden">
    <!-- Animated background particles/glows -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="sun-glow"></div>
        <div class="cloud-element" style="width: 400px; height: 150px; top: 10%; left: -10%; animation: drift-right 80s infinite linear;"></div>
        <div class="cloud-element" style="width: 300px; height: 100px; top: 40%; left: 80%; animation: drift-right 60s infinite linear reverse;"></div>
        <div class="cloud-element" style="width: 500px; height: 200px; bottom: 5%; left: 20%; animation: drift-right 100s infinite linear;"></div>
        <div class="beach-bg-highlight"></div>
    </div>

    <!-- Content Wrapper -->
    <div class="relative z-10">

        <!-- Header -->
        @include('components.header')

        <!-- Order Marquee Banner -->
        @include('components.order-marquee')

        <!-- Main Content -->
        <main class="relative">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Sea Waves Footer Component -->
        <div class="sea-footer">
            <div class="absolute top-0 left-0 w-full h-[100px] overflow-hidden leading-none transform rotate-180 pointer-events-none">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="footer-top-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="wave-animation">
                        <use xlink:href="#footer-top-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                        <use xlink:href="#footer-top-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                        <use xlink:href="#footer-top-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                        <use xlink:href="#footer-top-wave" x="48" y="7" fill="#fff" />
                    </g>
                </svg>
            </div>
            
            @include('components.footer')
            
            <div class="coconut-tree coconut-tree-left"></div>
            <div class="coconut-tree coconut-tree-right"></div>

            <!-- Animated Wave Overlay -->
            <div class="absolute bottom-0 left-0 w-full h-[150px] opacity-30 pointer-events-none">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="wave-animation">
                        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                        <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- Floating Action Buttons -->
        <div class="fixed bottom-4 md:bottom-6 right-4 md:right-6 flex flex-col gap-2 md:gap-3 z-50">
            <a href="https://www.facebook.com/le.vietanh.939173" class="w-10 h-10 md:w-12 md:h-12 bg-bg-card border border-primary/20 text-primary rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(34,197,94,0.3)] hover:bg-primary hover:text-bg-dark group">
                <span class="material-icons text-xl md:text-2xl">message</span>
            </a>
            <a href="tel:0327182537" class="w-10 h-10 md:w-12 md:h-12 bg-bg-card border border-primary/20 text-primary rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(34,197,94,0.3)] hover:bg-primary hover:text-bg-dark">
                <span class="material-icons text-xl md:text-2xl">phone</span>
            </a>
            <a href="https://zalo.me/g/wilgna867" class="w-10 h-10 md:w-12 md:h-12 bg-bg-card border border-primary/20 rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(34,197,94,0.3)] p-1">
                <img src="{{ asset('images/zalo.png') }}" alt="Zalo" class="w-full h-full rounded-full grayscale hover:grayscale-0 transition-all" loading="lazy" decoding="async">
            </a>
        </div>

        @livewire('auth.set-transaction-pin')
        @livewire('auth.set-security-question')

        <!-- Popup Modal -->
        @include('components.popup-modal')

        @livewireScripts
    </div> <!-- End Content Wrapper -->

    <script>
        document.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            const moveY = (e.clientY - window.innerHeight / 2) * 0.01;

            const sun = document.querySelector('.sun-glow');
            if (sun) sun.style.transform = `translate(${moveX * 2}px, ${moveY * 2}px)`;
            
            const clouds = document.querySelectorAll('.cloud-element');
            clouds.forEach((cloud, index) => {
                const speed = (index + 1) * 0.5;
                cloud.style.transform = `translate(${moveX * speed}px, ${moveY * speed}px)`;
            });
        });
    </script>
    
    @stack('scripts')
</body>

</html>