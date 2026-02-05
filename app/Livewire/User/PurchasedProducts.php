<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PurchasedProducts extends Component
{
    use WithPagination;

    public $selectedOrder = null;
    public $showModal = false;

    // Thuộc tính phục vụ xác thực mật khẩu cấp 2
    public $inputPassword2 = '';
    public $isVerified = false;

    protected $paginationTheme = 'tailwind';

    public function viewDetails($orderId)
    {
        $this->selectedOrder = \App\Models\Order::with('product')->find($orderId);
        $this->showModal = true;

        // Reset state mỗi lần mở modal
        $this->inputPassword2 = '';
        $this->isVerified = false;

    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
        $this->inputPassword2 = '';
        $this->isVerified = false;
    }

    public function verifyPassword()
    {
        $user = Auth::user();

        if (!$user->password2) {
            $this->addError('inputPassword2', 'Bạn chưa thiết lập mật khẩu cấp 2. Quay lại trang chủ để cài đặt.');
            return;
        }

        if (
            $this->selectedOrder &&
            $this->inputPassword2 == $user->password2
        ) {
            $this->isVerified = true;
            $this->inputPassword2 = '';
        } else {
            // Báo lỗi ngay dưới ô input
            $this->addError('inputPassword2', 'Mật khẩu cấp 2 không đúng');
        }
    }

    public function render()
    {
        $purchasedProducts = \App\Models\Order::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->paginate(6);

        return view('livewire.user.purchased-products', [
            'purchasedProducts' => $purchasedProducts
        ]);
    }
}
