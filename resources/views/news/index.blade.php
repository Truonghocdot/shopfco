@extends('layouts.app')

@section('title', 'Tin tức - VanhFCO')
@section('description', 'Cập nhật tin tức mới nhất về FC Online và các sự kiện hot.')

@push('styles')
<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuBsKRObr_MVqVSUYzPo-guc9soauRLmFJkvOfA5NJc8IWI0XazSVu7WJsY8o8kfBvO5heKgomdMEML4GoG44D4PjL-ZHyhOcCC499d22XF4In7K5cptXa6JgtEe2sF_Q9_IucnRuEOZATiTFkdsM7_fLgxidde6clT9GB8G3q164eje8YDNZNa6CVTpwYVG2uvcb4rNP0h3rY-tQ61PZKriHLKVUhBGF7bFLp_d4vyjJqGJQRo8LjH47LlBS1Ug2U3dD5ogNnWufQ90);
        background-attachment: fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-black uppercase mb-8 text-white flex items-center gap-3">
        <span class="material-icons text-primary text-4xl">newspaper</span>
        Tin tức & Sự kiện
    </h1>

    @if($news->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($news as $item)
        <article class="glass-morphism rounded-xl overflow-hidden group border border-slate-700 hover:border-primary transition">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ $item->thumbnail ?? 'https://via.placeholder.com/400x225' }}">
                <div class="absolute bottom-2 left-2 bg-black/80 backdrop-blur px-3 py-1 rounded text-xs text-slate-300 flex items-center gap-2">
                    <span class="material-icons text-sm">schedule</span>
                    {{ $item->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="p-5">
                <h3 class="font-bold text-lg mb-3 line-clamp-2 h-14 group-hover:text-primary transition">{{ $item->title }}</h3>
                @if($item->description)
                <p class="text-slate-400 text-sm line-clamp-3 mb-4">{{ $item->description }}</p>
                @endif
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span class="material-icons text-sm">visibility</span>
                        {{ number_format($item->view_count) }} lượt xem
                    </div>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-primary/80 font-bold text-sm flex items-center gap-1">
                        Đọc thêm <span class="material-icons text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $news->links() }}
    </div>
    @else
    <div class="glass-morphism rounded-xl p-12 text-center">
        <span class="material-icons text-6xl text-slate-600 mb-4">article</span>
        <p class="text-xl font-bold mb-2">Chưa có tin tức</p>
        <p class="text-slate-400">Hiện tại chưa có tin tức nào được đăng</p>
    </div>
    @endif
</div>
@endsection