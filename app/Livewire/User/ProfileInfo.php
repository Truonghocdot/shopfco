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
            'email' => 'required|email|max:150|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'current_password.required_with' => 'Vui lòng nhập mật khẩu hiện tại để đổi mật khẩu.',
            'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = Auth::user();

        $dataToUpdate = [
            'email' => $this->email,
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
