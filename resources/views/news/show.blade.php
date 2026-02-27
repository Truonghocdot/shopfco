@extends('layouts.app')

@section('title', $news->meta_title ?? $news->title . ' - VanhFCO')
@section('description', $news->meta_description ?? $news->description)

<style>
    .news-content {
        line-height: 1.8;
        color: #374151;
    }

    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
        border: 1px solid #e5e7eb;
    }

    .news-content h2,
    .news-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
        color: #D42020;
    }

    .news-content p {
        margin-bottom: 1rem;
    }
</style>

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="w-full mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-400 font-bold">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
            <span class="mx-2 text-gray-300">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors">Tin tức</a>
            <span class="mx-2 text-gray-300">/</span>
            <span class="text-primary">{{ $news->title }}</span>
        </div>

        <!-- Article -->
        <article class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-md mb-8">
            @if($news->thumbnail)
            <div class="aspect-video w-full overflow-hidden">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover" src="{{ url('storage/'.$news->thumbnail) }}" loading="lazy">
            </div>
            @endif

            <div class="p-8">
                <h1 class="text-3xl md:text-4xl font-black mb-4 text-gray-800">{{ $news->title }}</h1>

                <div class="flex items-center gap-6 text-sm text-gray-400 mb-6 pb-6 border-b border-gray-100">
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
                <div class="text-lg text-gray-500 mb-6 italic border-l-4 border-primary pl-4 bg-gray-50 p-4 rounded">
                    {!! $news->description !!}
                </div>
                @endif

                <div class="news-content">
                    {!! $news->content !!}
                </div>
            </div>
        </article>

        <!-- Related News -->
        @if($relatedNews->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-black mb-6 text-primary uppercase tracking-wide">Tin tức liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $item)
                <article class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg group transition-all hover:scale-[1.02]">
                    <div class="relative overflow-hidden aspect-video">
                        <img alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$item->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-sm mb-2 line-clamp-2 text-gray-800 group-hover:text-primary transition-colors">{{ $item->title }}</h3>
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 font-bold">
                            <span class="material-icons text-xs text-primary">schedule</span>
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                        <a href="{{ route('news.show', $item->slug) }}" class="text-primary hover:text-orange-500 font-bold text-sm flex items-center gap-1 transition-colors group/link">
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