<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\CouponUsage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Thanh toán')]
class CheckoutPage extends Component
{
    public $product;
    public $couponCode = '';
    public $appliedCoupon = null;
    public $discount = 0;
    public $couponMessage = '';
    public $couponValid = false;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('status', Product::STATUS_UNSOLD)
            ->with('category')
            ->firstOrFail();
    }

    public function getTitle()
    {
        return 'Thanh toán - ' . $this->product->title;
    }

    public function getWalletProperty()
    {
        return Auth::user()->wallet;
    }

    public function getOriginalPriceProperty()
    {
        return $this->product->getFinalPrice();
    }

    public function getFinalAmountProperty()
    {
        return $this->originalPrice - $this->discount;
    }

    public function applyCoupon()
    {
        $this->couponMessage = '';
        $this->couponValid = false;

        if (empty(trim($this->couponCode))) {
            $this->couponMessage = 'Vui lòng nhập mã giảm giá';
            return;
        }

        $coupon = Coupon::where('code', trim($this->couponCode))->first();

        if (!$coupon) {
            $this->couponMessage = 'Mã giảm giá không tồn tại';
            $this->resetCoupon();
            return;
        }

        $validation = $coupon->canBeUsedBy(Auth::user(), $this->originalPrice);

        if (!$validation['valid']) {
            $this->couponMessage = $validation['message'];
            $this->resetCoupon();
            return;
        }

        // Apply coupon successfully
        $this->appliedCoupon = $coupon;
        $this->discount = $coupon->calculateDiscount($this->originalPrice);
        $this->couponValid = true;
        $this->couponMessage = 'Mã giảm giá hợp lệ';
    }

    public function removeCoupon()
    {
        $this->resetCoupon();
        $this->couponCode = '';
        $this->couponMessage = '';
    }

    private function resetCoupon()
    {
        $this->appliedCoupon = null;
        $this->discount = 0;
        $this->couponValid = false;
    }

    public function purchase()
    {
        try {
            DB::beginTransaction();

            // Get product with lock
            $product = Product::where('id', $this->product->id)
                ->where('status', Product::STATUS_UNSOLD)
                ->lockForUpdate()
                ->firstOrFail();

            $user = Auth::user();
            $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();

            if (!$wallet) {
                throw new \Exception('Ví không tồn tại');
            }

            // Calculate final amount
            $productPrice = $product->getFinalPrice();
            $discountAmount = 0;
            $coupon = null;

            // Re-validate coupon if applied
            if ($this->appliedCoupon) {
                $coupon = Coupon::where('code', $this->appliedCoupon->code)->first();

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

            // Award lucky wheel spin if purchase >= 300,000đ
            if ($finalAmount >= 300000) {
                /**
                 * @var App\Models\User $user
                 */
                $user->increment('lucky_wheel_spins');
                session()->flash('lucky_spin_awarded', true);
            }

            DB::commit();

            return redirect()->route('purchase.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
