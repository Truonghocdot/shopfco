@extends('layouts.app')

@section('title', $news->meta_title ?? $news->title . ' - VanhFCO')
@section('description', $news->meta_description ?? $news->description)

<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuBsKRObr_MVqVSUYzPo-guc9soauRLmFJkvOfA5NJc8IWI0XazSVu7WJsY8o8kfBvO5heKgomdMEML4GoG44D4PjL-ZHyhOcCC499d22XF4In7K5cptXa6JgtEe2sF_Q9_IucnRuEOZATiTFkdsM7_fLgxidde6clT9GB8G3q164eje8YDNZNa6CVTpwYVG2uvcb4rNP0h3rY-tQ61PZKriHLKVUhBGF7bFLp_d4vyjJqGJQRo8LjH47LlBS1Ug2U3dD5ogNnWufQ90);
        background-attachment: fixed;
        background-size: cover;
    }

    .news-content {
        line-height: 1.8;
    }

    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }

    .news-content h2,
    .news-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .news-content p {
        margin-bottom: 1rem;
    }
</style>

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="w-full mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-primary">Tin tức</a>
            <span class="mx-2">/</span>
            <span class="">{{ $news->title }}</span>
        </div>

        <!-- Article Header -->
        <article class="glass-morphism rounded-xl overflow-hidden mb-8">
            @if($news->thumbnail)
            <div class="aspect-video w-full overflow-hidden">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover" src="{{ url('storage/'.$news->thumbnail) }}" loading="lazy">
            </div>
            @endif

            <div class="p-8">
                <h1 class="text-3xl md:text-4xl font-black mb-4">{{ $news->title }}</h1>

                <div class="flex items-center gap-6 text-sm text-slate-400 mb-6 pb-6 border-b border-slate-700">
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-sm">schedule</span>
                        {{ $news->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-sm">visibility</span>
                        {{ number_format($news->view_count) }} lượt xem
                    </div>
                </div>

                @if($news->description)
                <div class="text-lg text-slate-300 mb-6 italic">
                    {!! $news->description !!}
                </div>
                @endif

                <div class="news-content text-slate-800">
                    {!! $news->content !!}
                </div>
            </div>
        </article>

        <!-- Related News -->
        @if($relatedNews->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-black mb-6">Tin tức liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $item)
                <article class="glass-morphism rounded-xl overflow-hidden group border border-slate-700 hover:border-primary transition">
                    <div class="relative overflow-hidden aspect-video">
                        <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-sm mb-2 line-clamp-2 group-hover:text-primary transition">{{ $item->title }}</h3>
                        <div class="flex items-center gap-2 text-xs text-slate-500 mb-3">
                            <span class="material-icons text-xs">schedule</span>
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                        <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-primary/80 font-bold text-sm flex items-center gap-1">
                            Đọc thêm <span class="material-icons text-sm">arrow_forward</span>
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