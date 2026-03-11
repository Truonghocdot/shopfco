@extends('layouts.app')

@section('title', 'Tin Tức FC Online - VanhFCO | AccFCO - Sự Kiện & Cập Nhật')
@section('description', 'Cập nhật tin tức mới nhất về FC Online, sự kiện hot, hướng dẫn mua Acc chứa FC, Acc Mở thẻ tại VanhFCO.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tin tức', 'url' => route('news.index')]
    ]" />

    <div class="mb-12 text-center relative">
        <!-- Decorative background glow -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-white mb-3 flex justify-center items-center gap-4 relative z-10">
            <span class="material-icons text-4xl md:text-5xl text-primary drop-shadow-[0_0_10px_rgba(74,222,128,0.5)]">newspaper</span>
            TIN TỨC & SỰ KIỆN
        </h1>
        <p class="text-neutral-400 font-black uppercase tracking-[0.3em] text-xs md:text-sm">Cập nhật tin tức hot nhất về FC Online</p>
        <div class="h-1 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-8"></div>
    </div>

    @if($news->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($news as $item)
        <article class="card-esport group transition-all hover:scale-[1.02] relative">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                <div class="absolute bottom-2 left-2 bg-neutral-950/80 backdrop-blur-sm px-3 py-1 rounded text-[10px] text-neutral-300 font-bold flex items-center gap-2 border border-white/10 uppercase tracking-widest">
                    <span class="material-icons text-xs text-primary">schedule</span>
                    {{ $item->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="p-5 relative z-20">
                <h3 class="font-bold text-lg mb-3 line-clamp-2 h-14 text-neutral-100 group-hover:text-primary transition-colors tracking-tight leading-tight">{{ $item->title }}</h3>
                @if($item->description)
                <p class="text-neutral-600 text-sm line-clamp-3 mb-4 leading-relaxed font-bold">{!! $item->description !!}</p>
                @endif
                <div class="flex items-center justify-between pt-4 border-t border-white/5">
                    <div class="flex items-center gap-2 text-[10px] text-neutral-600 font-bold uppercase tracking-widest">
                        <span class="material-icons text-xs text-white">visibility</span>
                        {{ number_format($item->view_count) }} lượt xem
                    </div>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-white hover:text-white font-black text-xs uppercase tracking-widest flex items-center gap-1 transition-colors group/link">
                        ĐỌC THÊM <span class="material-icons text-sm group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
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
    <div class="glass rounded-2xl border border-white/10 p-12 text-center">
        <span class="material-icons text-6xl text-neutral-800 mb-6 drop-shadow-[0_0_15px_rgba(255,255,255,0.05)]">newspaper</span>
        <p class="text-2xl font-black mb-3 text-white uppercase tracking-tighter">Chưa có tin tức</p>
        <p class="text-neutral-600 font-bold">Hiện tại chưa có tin tức nào được cập nhật</p>
    </div>
    @endif
</div>
@endsection