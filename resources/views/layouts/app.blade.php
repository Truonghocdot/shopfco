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

<body class="min-h-screen bg-esport-darker bg-esport-gradient text-slate-200 selection:bg-primary/30 selection:text-white">
    <!-- Animated background particles/glows could be added here later -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-indigo-500/5 blur-[120px] rounded-full"></div>
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
            <a href="https://www.facebook.com/le.vietanh.939173" class="w-12 h-12 bg-slate-900 border border-primary/30 text-primary rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(56,189,248,0.3)] hover:bg-primary hover:text-white group">
                <span class="material-icons">message</span>
            </a>
            <a href="tel:0327182537" class="w-12 h-12 bg-slate-900 border border-primary/30 text-primary rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(56,189,248,0.3)] hover:bg-primary hover:text-white">
                <span class="material-icons">phone</span>
            </a>
            <a href="https://zalo.me/g/wilgna867" class="w-12 h-12 bg-slate-900 border border-primary/30 rounded-full flex items-center justify-center hover:scale-110 transition shadow-[0_0_15px_rgba(56,189,248,0.3)] p-1">
                <img src="{{ asset('images/zalo.png') }}" alt="Zalo" class="w-full h-full rounded-full grayscale hover:grayscale-0 transition-all">
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