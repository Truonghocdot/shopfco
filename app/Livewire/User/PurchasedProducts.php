<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PurchasedProducts extends Component
{
    use WithPagination;

    public function render()
    {
        // Get purchased orders
        $purchasedProducts = \App\Models\Order::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->paginate(6);

        return view('livewire.user.purchased-products', [
            'purchasedProducts' => $purchasedProducts
        ]);
    }
}
