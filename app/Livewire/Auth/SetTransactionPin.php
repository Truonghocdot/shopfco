<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class SetTransactionPin extends Component
{
    public $pin = '';
    public $pin_confirmation = '';
    public $showModal = false;

    public function mount()
    {
        $this->checkPinStatus();
    }

    public function checkPinStatus()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Nếu chưa có password2 thì hiện modal
            if (empty($user->password2)) {
                $this->showModal = true;
            } else {
                $this->showModal = false;
            }
        }
    }

    public function savePin()
    {
        $this->validate([
            'pin' => [
                'required',
                'numeric',
                'digits:6',
                'confirmed', // checks matching pin_confirmation
            ],
        ],
            [
                'pin.required' => 'Mã PIN không được để trống',
                'pin.numeric' => 'Mã PIN phải là số',
                'pin.digits' => 'Mã PIN phải có 6 số',
                'pin.confirmed' => 'Mã PIN không khớp',
            ]);

        $user = Auth::user();

        // update
        /** @var User $user */
        $user->forceFill([
            'password2' => $this->pin
        ])->save();

        $this->showModal = false;

        // Dispatch event or notification if needed
        $this->dispatch('pin-updated');

        // Có thể reload trang để app nhận diện state mới
        $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.set-transaction-pin');
    }
}
