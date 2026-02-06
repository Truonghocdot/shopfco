<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', Product::STATUS_UNSOLD)
            ->with('category');

        // Filter by category (support parent-child hierarchy)
        if ($request->filled('category')) {
            $category = Category::find($request->category);

            if ($category) {
                // If it's a parent category, include all child categories
                if ($category->isParent() && $category->hasChildren()) {
                    $categoryIds = $category->children()->pluck('id')->push($category->id);
                    $query->whereIn('category_id', $categoryIds);
                } else {
                    $query->where('category_id', $request->category);
                }
            }
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $q->where('sale_price', '>=', $request->min_price)
                    ->orWhere(function ($q2) use ($request) {
                        $q2->whereNull('sale_price')
                            ->where('sell_price', '>=', $request->min_price);
                    });
            });
        }

        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $q->where('sale_price', '<=', $request->max_price)
                    ->orWhere(function ($q2) use ($request) {
                        $q2->whereNull('sale_price')
                            ->where('sell_price', '<=', $request->max_price);
                    });
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(sale_price, sell_price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(sale_price, sell_price) DESC');
                break;
            case 'discount':
                $query->whereNotNull('sale_price')
                    ->where('sell_price', '>', 0)
                    ->orderByRaw('((sell_price - sale_price) / sell_price) DESC');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);

        // Get categories with parent-child relationships
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('title')
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', Product::STATUS_UNSOLD)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
