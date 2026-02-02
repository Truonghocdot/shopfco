<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-4 border-b border-slate-200">
        <h2 class="text-slate-900 text-lg font-bold">Cập nhật thông tin</h2>
    </div>

    @if (session()->has('success'))
    <div class="px-6 pt-6">
        <div class="p-4 bg-green-100 text-green-700 rounded-lg flex items-center gap-2">
            <span class="material-icons">check_circle</span>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-slate-600 text-sm font-bold">Họ và tên</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">badge</span>
                    <input wire:model="name" type="text" readonly class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-slate-50 border border-slate-200 text-slate-500 font-medium cursor-not-allowed">
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-slate-600 text-sm font-bold">Số điện thoại</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">call</span>
                    <input wire:model="phone" type="text" class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-primary-blue focus:ring-1 focus:ring-primary-blue outline-none transition-all font-medium text-slate-800 placeholder:text-slate-400">
                </div>
                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-slate-600 text-sm font-bold">Email</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                    <input wire:model="email" type="email" class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-primary-blue focus:ring-1 focus:ring-primary-blue outline-none transition-all font-medium text-slate-800 placeholder:text-slate-400">
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h3 class="text-slate-900 font-bold mb-4 flex items-center gap-2">
                <span class="material-icons text-slate-400">lock</span>
                Đổi mật khẩu
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-600 text-sm font-bold">Mật khẩu hiện tại</label>
                    <div class="relative w-full">
                        <input wire:model="current_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg border border-slate-200 focus:border-primary-blue focus:ring-1 focus:ring-primary-blue outline-none transition-all text-slate-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- New Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-600 text-sm font-bold">Mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg border border-slate-200 focus:border-primary-blue focus:ring-1 focus:ring-primary-blue outline-none transition-all text-slate-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-600 text-sm font-bold">Xác nhận mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password_confirmation" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg border border-slate-200 focus:border-primary-blue focus:ring-1 focus:ring-primary-blue outline-none transition-all text-slate-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-primary-blue hover:bg-blue-600 text-slate-800 font-bold py-2.5 px-6 rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                <span class="material-icons text-[20px]">save</span>
                <span wire:loading.remove>Lưu thay đổi</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Đang lưu...
                </span>
            </button>
        </div>
    </form>
</div>