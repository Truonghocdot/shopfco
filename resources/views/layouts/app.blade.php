<!DOCTYPE html>
<html lang="vi">

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

<body class="min-h-screen relative">
    <!-- Tet Holiday Background -->
    <div id="tet-bg" class="fixed inset-0 z-0 pointer-events-none transition-all duration-1000 ease-in-out"
        style="background-size: cover; background-position: center; background-image: url('{{ asset("bg-tet-3.png") }}'); -webkit-backface-visibility: hidden; -webkit-transform: translate3d(0,0,0); will-change: transform;">
    </div>

    <!-- Content Wrapper -->
    <div class="relative z-10">

        <!-- Header -->
        @include('components.header')

        <!-- Order Marquee Banner -->
        @include('components.order-marquee')

        <!-- Main Content -->
        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')

        <!-- Floating Action Buttons -->
        <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-50">
            <a href="https://www.facebook.com/le.vietanh.939173" class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg">
                <span class="material-icons">message</span>
            </a>
            <a href="tel:0327182537" class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg">
                <span class="material-icons">phone</span>
            </a>
            <a href="https://zalo.me/g/wilgna867" class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg">
                <img src="{{ asset('images/zalo.png') }}" alt="Zalo" class="w-12 h-12 rounded-full">
            </a>
        </div>

        @livewire('auth.set-transaction-pin')
        @livewire('auth.set-security-question')

        <!-- Popup Modal -->
        @include('components.popup-modal')

        @livewireScripts
    </div> <!-- End Content Wrapper -->
</body>

</html>