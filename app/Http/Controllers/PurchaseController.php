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
    /**
     * Show checkout page for a product
     */
    public function checkout($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', Product::STATUS_UNSOLD)
            ->with('category')
            ->firstOrFail();

        $wallet = Auth::user()->wallet;

        return view('checkout', compact('product', 'wallet'));
    }

    /**
     * Validate coupon code
     */
    public function validateCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá không tồn tại'
            ]);
        }

        $validation = $coupon->canBeUsedBy(Auth::user(), $request->amount);

        if (!$validation['valid']) {
            return response()->json($validation);
        }

        $discount = $coupon->calculateDiscount($request->amount);
        $finalAmount = $request->amount - $discount;

        return response()->json([
            'valid' => true,
            'message' => 'Mã giảm giá hợp lệ',
            'discount' => $discount,
            'final_amount' => $finalAmount,
            'coupon_id' => $coupon->id,
        ]);
    }

    /**
     * Process purchase
     */
    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'coupon_code' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Get product
            $product = Product::where('id', $request->product_id)
                ->where('status', Product::STATUS_UNSOLD)
                ->lockForUpdate()
                ->firstOrFail();

            $user = Auth::user();
            $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();

            if (!$wallet) {
                throw new \Exception('Ví không tồn tại');
            }

            // Calculate price
            $productPrice = $product->getFinalPrice();
            $discountAmount = 0;
            $coupon = null;

            // Apply coupon if provided
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)->first();

                if (!$coupon) {
                    throw new \Exception('Mã giảm giá không tồn tại');
                }

                $validation = $coupon->canBeUsedBy($user, $productPrice);
                if (!$validation['valid']) {
                    throw new \Exception($validation['message']);
                }

                $discountAmount = $coupon->calculateDiscount($productPrice);
            }

            $finalAmount = $productPrice - $discountAmount;

            // Check wallet balance
            if ($wallet->balance < $finalAmount) {
                throw new \Exception('Số dư không đủ. Vui lòng nạp thêm tiền.');
            }

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'coupon_id' => $coupon?->id,
                'order_number' => Order::generateOrderNumber(),
                'product_price' => $productPrice,
                'discount_amount' => $discountAmount,
                'final_amount' => $finalAmount,
                'status' => Order::STATUS_COMPLETED,
                'wallet_balance_before' => $wallet->balance,
                'wallet_balance_after' => $wallet->balance - $finalAmount,
                'completed_at' => now(),
            ]);

            // Update product status
            $product->update(['status' => Product::STATUS_SOLD]);

            // Deduct wallet balance
            $wallet->decrement('balance', $finalAmount);

            // Record coupon usage
            if ($coupon) {
                $coupon->incrementUsage();
                CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                ]);
            }

            DB::commit();

            return redirect()->route('user.profile')
                ->with('success', 'Mua hàng thành công! Mã đơn hàng: ' . $order->order_number);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
