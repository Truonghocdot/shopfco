<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('published', 1)
            ->latest()
            ->paginate(9);

        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('published', 1)
            ->firstOrFail();

        // Increment view count
        $news->increment('view_count');

        // Get related news
        $relatedNews = News::where('published', 1)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
