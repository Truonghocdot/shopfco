<div>
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-75 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 transform transition-all scale-100">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">
                    Thiết lập Mật khẩu cấp 2
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    Để bảo vệ tài khoản, vui lòng thiết lập mật khẩu giao dịch (6 số, cấp quyền truy cập thông tin tài khoản đã mua). Đây KHÔNG phải mật khẩu đăng nhập.
                </p>

                <form wire:submit.prevent="savePin">
                    <div class="mb-4 text-left">
                        <label for="pin" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu cấp 2 (6 số)</label>
                        <input type="password" wire:model="pin" id="pin"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center tracking-widest text-lg"
                            placeholder="******" maxlength="6" inputmode="numeric">
                        @error('pin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6 text-left">
                        <label for="pin_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Nhập lại mật khẩu</label>
                        <input type="password" wire:model="pin_confirmation" id="pin_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center tracking-widest text-lg"
                            placeholder="******" maxlength="6" inputmode="numeric">
                    </div>

                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm transition-colors duration-200">
                        Xác nhận và Lưu
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>