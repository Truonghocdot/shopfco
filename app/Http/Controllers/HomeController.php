<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('home', compact('categories', 'flashSaleProducts', 'latestNews'));
    }
}
