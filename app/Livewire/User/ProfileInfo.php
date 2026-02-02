<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileInfo extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
        } else {
            Log::error('ProfileInfo component: User not authenticated');
        }
    }

    public function updateProfile()
    {
        $rules = [
            'email' => 'required|email|max:150|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ];

        $messages = [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
        ];

        // If new password is provided, require current password and confirmation
        if (!empty($this->new_password)) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['new_password'] = ['required', 'min:8', 'confirmed'];

            $messages['current_password.required'] = 'Vui lòng nhập mật khẩu hiện tại để đổi mật khẩu.';
            $messages['current_password.current_password'] = 'Mật khẩu hiện tại không đúng.';
            $messages['new_password.required'] = 'Vui lòng nhập mật khẩu mới.';
            $messages['new_password.min'] = 'Mật khẩu mới phải có ít nhất 8 ký tự.';
            $messages['new_password.confirmed'] = 'Xác nhận mật khẩu mới không khớp.';
        }

        $this->validate($rules, $messages);

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
