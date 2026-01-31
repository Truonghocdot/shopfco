<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileInfo extends Component
{
    public $name;
    public $email;
    public $phone;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        $dataToUpdate = [
            'name' => $this->name,
            'phone' => $this->phone,
        ];

        // Only update password if provided
        if ($this->new_password) {
            $dataToUpdate['password'] = \Illuminate\Support\Facades\Hash::make($this->new_password);
        }

        $user->update($dataToUpdate);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('success', 'Cập nhật thông tin thành công!');
    }

    public function render()
    {
        return view('livewire.user.profile-info');
    }
}
