<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Services\LeaderboardService;

class HomeController extends Controller
{
    public function index(LeaderboardService $leaderboardService)
    {
        $banners = Cache::remember('home_banners', 3600, function () {
            return Banner::orderBy('sort', 'asc')->get();
        });

        // Get 4 featured categories
        $categories = Category::latest()->take(4)->get();

        // Get 8 flash sale products (highest discount)
        $flashSaleProducts = Product::where('status', Product::STATUS_UNSOLD)
            ->whereNotNull('sale_price')
            ->whereNotNull('sell_price')
            ->with('category')
            ->latest()
            ->take(8)
            ->get()
            ->sortByDesc(function ($product) {
                return $product->getDiscountPercent();
            })
            ->take(8);

        // Get 4 latest news
        $latestNews = News::where('published', 1)
            ->latest()
            ->take(8)
            ->get();

        // Get top 10 spenders for leaderboard
        $topSpenders = $leaderboardService->getTopSpenders(10);

        return view('home', compact('categories', 'flashSaleProducts', 'latestNews', 'topSpenders', 'banners'));
    }
}
