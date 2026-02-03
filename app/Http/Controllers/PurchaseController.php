<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    public function success($id)
    {
        $order = Order::with('product.category')->where('user_id', Auth::id())->findOrFail($id);
        return view('purchase.success', compact('order'));
    }
}
