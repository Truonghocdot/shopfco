<?php

namespace App\Livewire;

use App\Services\OrderService;
use App\Services\CouponService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
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

    protected $orderService;
    protected $couponService;
    protected $productService;

    public function boot(
        OrderService $orderService,
        CouponService $couponService,
        ProductService $productService
    ) {
        $this->orderService = $orderService;
        $this->couponService = $couponService;
        $this->productService = $productService;
    }

    public function mount($slug)
    {
        $productResult = $this->productService->getProductBySlug($slug, true);

        if ($productResult->isError()) {
            abort(404, $productResult->getMessage());
        }

        $this->product = $productResult->getData();

        // Check if product is still available
        if ($this->product->status !== \App\Models\Product::STATUS_UNSOLD) {
            abort(404, 'Sản phẩm đã được bán');
        }
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

        $validationResult = $this->couponService->validateCoupon(
            trim($this->couponCode),
            Auth::id(),
            $this->originalPrice,
            $this->product
        );

        if ($validationResult->isError()) {
            $this->couponMessage = $validationResult->getMessage();
            $this->resetCoupon();
            return;
        }

        // Apply coupon successfully
        $this->appliedCoupon = $validationResult->getData();
        $this->discount = $this->appliedCoupon->calculateDiscount($this->originalPrice);
        $this->couponValid = true;
        $this->couponMessage = $validationResult->getMessage();
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
        $couponCode = $this->appliedCoupon ? $this->appliedCoupon->code : null;

        $result = $this->orderService->purchaseProduct(
            Auth::id(),
            $this->product->id,
            $couponCode
        );

        if ($result->isError()) {
            session()->flash('error', $result->getMessage());
            return;
        }

        $order = $result->getData();

        // Check if lucky spin was awarded
        if ($order->final_amount >= 300000) {
            session()->flash('lucky_spin_awarded', true);
        }

        return redirect()->route('purchase.success', $order->id);
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
