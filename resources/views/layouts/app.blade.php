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
            <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform rotate-180">
                <svg class="relative block w-full h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5,73.84-4.36,147.54,16.88,218.2,35.26,69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113,2,1200,82.58V0Z" opacity=".25" fill="#FFFFFF"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.51V0Z" opacity=".5" fill="#FFFFFF"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#FFFFFF"></path>
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
                <img src="{{ asset('images/zalo.png') }}" alt="Zalo" class="w-full h-full rounded-full grayscale hover:grayscale-0 transition-all">
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
</body>

</html>