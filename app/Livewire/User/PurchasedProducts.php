<?php

namespace App\Livewire\User;

use App\Services\OrderService;
use App\Services\UserService;
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

    protected $orderService;
    protected $userService;

    public function boot(
        OrderService $orderService,
        UserService $userService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function viewDetails($orderId)
    {
        $orderResult = $this->orderService->getOrderById($orderId, Auth::id());

        if ($orderResult->isError()) {
            session()->flash('error', $orderResult->getMessage());
            return;
        }

        $this->selectedOrder = $orderResult->getData();
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
        $result = $this->userService->verifyTransactionPin(Auth::id(), $this->inputPassword2);

        if ($result->isError()) {
            $this->addError('inputPassword2', $result->getMessage());
            return;
        }

        $this->isVerified = true;
        $this->inputPassword2 = '';
    }

    public function render()
    {
        $purchasedProductsResult = $this->orderService->getUserOrders(Auth::id(), 6);
        $purchasedProducts = $purchasedProductsResult->isSuccess()
            ? $purchasedProductsResult->getData()
            : collect();

        return view('livewire.user.purchased-products', [
            'purchasedProducts' => $purchasedProducts
        ]);
    }
}
