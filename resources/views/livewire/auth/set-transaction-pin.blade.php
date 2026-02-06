<div>
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm">
        <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/50 rounded-lg shadow-[0_0_50px_rgba(0,255,0,0.4)] w-full max-w-md p-6 transform transition-all scale-100 overflow-hidden">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="text-center relative z-10">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-900/30 border-2 border-red-500/50 mb-4 shadow-[0_0_20px_rgba(239,68,68,0.4)]">
                    <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-black text-primary mb-2 drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">
                    Thiết lập Mật khẩu cấp 2
                </h3>
                <p class="text-sm text-slate-400 mb-6">
                    Để bảo vệ tài khoản, vui lòng thiết lập mật khẩu giao dịch (6 số, cấp quyền truy cập thông tin tài khoản đã mua). Đây KHÔNG phải mật khẩu đăng nhập.
                </p>

                <form wire:submit.prevent="savePin">
                    <div class="mb-4 text-left">
                        <label for="pin" class="block text-sm font-bold text-slate-400 mb-1 uppercase tracking-wide">Mật khẩu cấp 2 (6 số)</label>
                        <input type="password" wire:model="pin" id="pin"
                            class="w-full px-3 py-2 bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-2 focus:ring-primary rounded-md outline-none text-center tracking-widest text-lg text-white"
                            placeholder="******" maxlength="6" inputmode="numeric">
                        @error('pin') <span class="text-red-500 text-xs mt-1 drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6 text-left">
                        <label for="pin_confirmation" class="block text-sm font-bold text-slate-400 mb-1 uppercase tracking-wide">Nhập lại mật khẩu</label>
                        <input type="password" wire:model="pin_confirmation" id="pin_confirmation"
                            class="w-full px-3 py-2 bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-2 focus:ring-primary rounded-md outline-none text-center tracking-widest text-lg text-white"
                            placeholder="******" maxlength="6" inputmode="numeric">
                    </div>

                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border-2 border-primary/50 shadow-[0_0_25px_rgba(0,255,0,0.4)] hover:shadow-[0_0_35px_rgba(0,255,0,0.6)] px-4 py-2 bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-base font-black text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:text-sm transition-all duration-200 uppercase tracking-wide">
                        Xác nhận và Lưu
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>