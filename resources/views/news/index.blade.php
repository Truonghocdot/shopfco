@extends('layouts.app')

@section('title', 'Tin Tức FC Online - VanhFCO | AccFCO - Sự Kiện & Cập Nhật')
@section('description', 'Cập nhật tin tức mới nhất về FC Online, sự kiện hot, hướng dẫn mua Acc chứa FC, Acc Mở thẻ tại VanhFCO.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tin tức', 'url' => route('news.index')]
    ]" />

    <div class="mb-10 text-center relative">
        <!-- Floating decorations -->
        <img src="{{ asset('images/hoa2.webp') }}" class="absolute -top-10 left-10 w-32 opacity-70 animate-shake hidden md:block">
        <img src="{{ asset('images/phao3.webp') }}" class="absolute -top-10 right-10 w-24 opacity-80 animate-swing hidden md:block">

        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3 relative z-10">
            <span class="material-icons text-4xl md:text-5xl text-white">newspaper</span>
            TIN TỨC & SỰ KIỆN
        </h1>
        <p class="text-gray-200 font-bold uppercase tracking-widest text-sm">Cập nhật tin tức hot nhất về FC Online</p>
        <div class="h-1.5 w-48 bg-linear-to-r from-transparent via-white to-transparent mx-auto rounded-full mt-6"></div>
    </div>

    @if($news->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($news as $item)
        <article class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg group transition-all hover:scale-[1.02] relative">
            <!-- Decorative lixi -->
            <img src="{{ asset('images/lixi1.png') }}" alt="" class="absolute -bottom-4 -right-4 w-24 opacity-60 rotate-12 pointer-events-none z-10 transition-transform group-hover:scale-110 animate-swing">

            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                <div class="absolute bottom-2 left-2 bg-white/90 px-3 py-1 rounded text-xs text-gray-600 font-bold flex items-center gap-2">
                    <span class="material-icons text-sm">schedule</span>
                    {{ $item->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="p-5 relative z-20">
                <h3 class="font-bold text-lg mb-3 line-clamp-2 h-14 text-gray-800 group-hover:text-primary transition-colors">{{ $item->title }}</h3>
                @if($item->description)
                <p class="text-gray-400 text-sm line-clamp-3 mb-4">{!! $item->description !!}</p>
                @endif
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <span class="material-icons text-sm text-primary">visibility</span>
                        {{ number_format($item->view_count) }} lượt xem
                    </div>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-orange-500 font-bold text-sm flex items-center gap-1 transition-colors group/link">
                        Đọc thêm <span class="material-icons text-sm group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $news->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <div class="bg-white rounded-xl border border-gray-200 shadow-md p-12 text-center">
        <span class="material-icons text-6xl text-gray-300 mb-4">article</span>
        <p class="text-xl font-black mb-2 text-primary">Chưa có tin tức</p>
        <p class="text-gray-400">Hiện tại chưa có tin tức nào được đăng</p>
    </div>
    @endif
</div>
@endsection