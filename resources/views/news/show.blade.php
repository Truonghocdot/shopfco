@extends('layouts.app')

@section('title', $news->meta_title ?? $news->title . ' - VanhFCO')
@section('description', $news->meta_description ?? $news->description)

<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }

    .news-content {
        line-height: 1.8;
        color: #e2e8f0;
    }

    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
        border: 2px solid rgba(0, 255, 0, 0.2);
    }

    .news-content h2,
    .news-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
        color: #00ff00;
        text-shadow: 0 0 10px rgba(0, 255, 0, 0.6);
    }

    .news-content p {
        margin-bottom: 1rem;
    }
</style>

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="w-full mx-auto">
        <!-- Breadcrumb - Techno Style -->
        <div class="mb-6 text-sm text-slate-500 font-bold">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
            <span class="mx-2 text-primary">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors">Tin tức</a>
            <span class="mx-2 text-primary">/</span>
            <span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">{{ $news->title }}</span>
        </div>

        <!-- Article Header - Techno Style -->
        <article class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl overflow-hidden mb-8 shadow-[0_0_40px_rgba(0,255,0,0.3)]">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px);"></div>
            </div>

            @if($news->thumbnail)
            <div class="aspect-video w-full overflow-hidden border-b-2 border-primary/20">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover" src="{{ url('storage/'.$news->thumbnail) }}" loading="lazy">
            </div>
            @endif

            <div class="p-8 relative z-10">
                <h1 class="text-3xl md:text-4xl font-black mb-4 text-primary drop-shadow-[0_0_15px_rgba(0,255,0,0.8)]">{{ $news->title }}</h1>

                <div class="flex items-center gap-6 text-sm text-slate-400 mb-6 pb-6 border-b-2 border-primary/20">
                    <div class="flex items-center gap-2 font-bold">
                        <span class="material-icons text-sm text-primary">schedule</span>
                        {{ $news->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center gap-2 font-bold">
                        <span class="material-icons text-sm text-primary">visibility</span>
                        {{ number_format($news->view_count) }} lượt xem
                    </div>
                </div>

                @if($news->description)
                <div class="text-lg text-slate-300 mb-6 italic border-l-4 border-primary pl-4 bg-black/40 p-4 rounded shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                    {!! clean($news->description) !!}
                </div>
                @endif

                <div class="news-content">
                    {!! clean($news->content) !!}
                </div>
            </div>
        </article>

        <!-- Related News - Techno Style -->
        @if($relatedNews->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-black mb-6 text-primary drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] uppercase tracking-wide">Tin tức liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $item)
                <article class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-slate-700 hover:border-primary rounded-xl overflow-hidden group transition-all hover:shadow-[0_0_30px_rgba(0,255,0,0.3)] hover:scale-[1.02]">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none transition-opacity">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <div class="relative overflow-hidden aspect-video">
                        <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                    </div>
                    <div class="p-4 relative z-10">
                        <h3 class="font-bold text-sm mb-2 line-clamp-2 text-white group-hover:text-primary transition-colors">{{ $item->title }}</h3>
                        <div class="flex items-center gap-2 text-xs text-slate-500 mb-3 font-bold">
                            <span class="material-icons text-xs text-primary">schedule</span>
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                        <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-green-400 font-bold text-sm flex items-center gap-1 transition-colors group/link">
                            Đọc thêm <span class="material-icons text-sm group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection