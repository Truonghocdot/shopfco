@extends('layouts.app')

@section('title', 'Tin Tức FC Online - VanhFCO | AccFCO - Sự Kiện & Cập Nhật')
@section('description', 'Cập nhật tin tức mới nhất về FC Online, sự kiện hot, hướng dẫn mua Acc chứa FC, Acc Mở thẻ tại VanhFCO.')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tin tức', 'url' => route('news.index')]
    ]" />

    <h1 class="text-4xl font-black uppercase mb-8 text-primary flex items-center gap-3 drop-shadow-[0_0_20px_rgba(0,255,0,0.8)] tracking-wider">
        <span class="material-icons text-4xl">newspaper</span>
        Tin tức & Sự kiện
    </h1>

    @if($news->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($news as $item)
        <article class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-slate-700 hover:border-primary rounded-xl overflow-hidden group transition-all hover:shadow-[0_0_30px_rgba(0,255,0,0.3)] hover:scale-[1.02]">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none transition-opacity">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                <div class="absolute bottom-2 left-2 bg-black/70 backdrop-blur-sm border border-primary/30 px-3 py-1 rounded text-xs text-primary font-bold flex items-center gap-2 shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                    <span class="material-icons text-sm">schedule</span>
                    {{ $item->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="p-5 relative z-10">
                <h3 class="font-bold text-lg mb-3 line-clamp-2 h-14 text-white group-hover:text-primary transition-colors">{{ $item->title }}</h3>
                @if($item->description)
                <p class="text-slate-400 text-sm line-clamp-3 mb-4">{!! $item->description !!}</p>
                @endif
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span class="material-icons text-sm text-primary">visibility</span>
                        {{ number_format($item->view_count) }} lượt xem
                    </div>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-green-400 font-bold text-sm flex items-center gap-1 transition-colors group/link">
                        Đọc thêm <span class="material-icons text-sm group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination with Techno Style -->
    <div class="mt-8">
        {{ $news->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-12 text-center overflow-hidden">
        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
        </div>

        <span class="material-icons text-6xl text-slate-700 mb-4 drop-shadow-[0_0_10px_rgba(0,255,0,0.3)] relative z-10">article</span>
        <p class="text-xl font-black mb-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10">Chưa có tin tức</p>
        <p class="text-slate-500 relative z-10">Hiện tại chưa có tin tức nào được đăng</p>
    </div>
    @endif
</div>
@endsection