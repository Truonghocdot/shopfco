<div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
    </div>

    <div class="p-4 border-b border-primary/20 relative z-10">
        <h2 class="text-primary text-lg font-black drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">Cập nhật thông tin</h2>
    </div>

    @if (session()->has('success'))
    <div class="px-6 pt-6 relative z-10">
        <div class="p-4 bg-primary/20 border-2 border-primary/50 text-primary rounded-lg flex items-center gap-2 shadow-[0_0_15px_rgba(0,255,0,0.3)]">
            <span class="material-icons">check_circle</span>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="p-6 space-y-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Họ và tên</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-600 text-[20px]">badge</span>
                    <input wire:model="name" type="text" readonly class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 text-slate-500 font-medium cursor-not-allowed">
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 block drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Số điện thoại</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-600 text-[20px]">call</span>
                    <input wire:model="phone" type="text" class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-medium text-white placeholder:text-slate-600">
                </div>
                @error('phone') <span class="text-red-500 text-xs mt-1 block drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Email</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-600 text-[20px]">mail</span>
                    <input wire:model="email" type="email" class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-medium text-white placeholder:text-slate-600">
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 block drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-t border-primary/20 pt-6">
            <h3 class="text-white font-black mb-4 flex items-center gap-2 drop-shadow-[0_0_10px_rgba(255,255,255,0.5)]">
                <span class="material-icons text-primary">lock</span>
                Đổi mật khẩu
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Mật khẩu hiện tại</label>
                    <div class="relative w-full">
                        <input wire:model="current_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-white">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-600 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('current_password') <span class="text-red-500 text-xs mt-1 block drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
                </div>

                <!-- New Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-white">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-600 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('new_password') <span class="text-red-500 text-xs mt-1 block drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-slate-400 text-sm font-bold uppercase tracking-wide">Xác nhận mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password_confirmation" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-white">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-600 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-black font-black py-2.5 px-6 rounded-lg shadow-[0_0_20px_rgba(0,255,0,0.4)] hover:shadow-[0_0_30px_rgba(0,255,0,0.6)] transition-all flex items-center gap-2 border-2 border-primary/50 uppercase tracking-wide">
                <span class="material-icons text-[20px]">save</span>
                <span wire:loading.remove>Lưu thay đổi</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Đang lưu...
                </span>
            </button>
        </div>
    </form>
</div>