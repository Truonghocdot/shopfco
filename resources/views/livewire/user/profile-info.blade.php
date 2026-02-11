<div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden">
    <div class="p-4 border-b border-gray-100">
        <h2 class="text-primary text-lg font-black uppercase tracking-wide">Cập nhật thông tin</h2>
    </div>

    @if (session()->has('success'))
    <div class="px-6 pt-6">
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
            <span class="material-icons">check_circle</span>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Affiliate Link Section -->
    <div class="px-6 pb-6 pt-6">
        <div class="border border-gray-200 rounded-xl p-6">
            <h3 class="text-primary font-black mb-3 flex items-center gap-2 uppercase tracking-wide text-sm">
                <span class="material-icons text-base">share</span>
                Link giới thiệu của bạn
            </h3>
            <p class="text-gray-500 text-xs mb-4">Chia sẻ link này để nhận 5% hoa hồng từ mỗi đơn hàng của người bạn giới thiệu</p>

            <div class="flex gap-2">
                <div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg px-4 py-3 font-mono text-xs text-gray-700 break-all">
                    {{ $this->affiliateUrl }}
                </div>
                <button
                    type="button"
                    onclick="navigator.clipboard.writeText('{{ $this->affiliateUrl }}'); alert('Đã copy link giới thiệu!');"
                    class="shrink-0 bg-primary hover:bg-primary-dark text-white px-4 py-3 rounded-lg transition-all active:scale-95 flex items-center gap-2 font-bold uppercase text-xs whitespace-nowrap">
                    <span class="material-icons text-sm">content_copy</span>
                    Copy
                </button>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-4">
                <div class="bg-white border border-gray-200 rounded-lg p-3">
                    <p class="text-gray-500 text-xs uppercase mb-1">Người đã giới thiệu</p>
                    <p class="text-gray-800 font-black text-xl">{{ auth()->user()->referrals()->count() }}</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">
                    <p class="text-gray-500 text-xs uppercase mb-1">Tổng hoa hồng</p>
                    <p class="text-primary font-black text-xl">
                        {{ number_format(auth()->user()->commissionsEarned()->where('status', 'paid')->sum('commission_amount')) }}đ
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="updateProfile" class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Họ và tên</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">badge</span>
                    <input wire:model="name" type="text" readonly class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 text-gray-500 font-medium cursor-not-allowed">
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Số điện thoại</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">call</span>
                    <input wire:model="phone" type="text" class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-medium text-gray-800 placeholder:text-gray-400">
                </div>
                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Email</label>
                <div class="relative">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
                    <input wire:model="email" type="email" class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-medium text-gray-800 placeholder:text-gray-400">
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-gray-800 font-black mb-4 flex items-center gap-2">
                <span class="material-icons text-primary">lock</span>
                Đổi mật khẩu
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Mật khẩu hiện tại</label>
                    <div class="relative w-full">
                        <input wire:model="current_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-gray-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-gray-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Xác nhận mật khẩu mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password_confirmation" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-gray-800">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password2 Section -->
        <div class="border-t border-gray-100 pt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-800 font-black flex items-center gap-2">
                    <span class="material-icons text-primary">enhanced_encryption</span>
                    Đổi mật khẩu cấp 2
                </h3>
                <button type="button" wire:click="togglePassword2Form"
                    class="text-primary hover:text-primary-dark text-sm font-bold uppercase tracking-wide flex items-center gap-1 transition-colors">
                    <span class="material-icons text-sm">{{ $showPassword2Form ? 'expand_less' : 'expand_more' }}</span>
                    {{ $showPassword2Form ? 'Ẩn' : 'Mở' }}
                </button>
            </div>

            @if($showPassword2Form)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(!empty(auth()->user()->password2) && auth()->user()->hasSecurityQuestion())
                <div class="space-y-2 md:col-span-2">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">
                        Câu hỏi bảo mật: <span class="text-primary">{{ $this->securityQuestionText }}</span>
                    </label>
                    <div class="relative">
                        <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">quiz</span>
                        <input wire:model="security_answer" type="text"
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-medium text-gray-800 placeholder:text-gray-400"
                            placeholder="Nhập câu trả lời bảo mật...">
                    </div>
                    @error('security_answer') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Mật khẩu cấp 2 mới (6 số)</label>
                    <div class="relative w-full">
                        <input wire:model="new_password2" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-gray-800"
                            placeholder="******" maxlength="6" inputmode="numeric">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('new_password2') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2" x-data="{ show: false }">
                    <label class="text-gray-600 text-sm font-bold uppercase tracking-wide">Xác nhận mật khẩu cấp 2 mới</label>
                    <div class="relative w-full">
                        <input wire:model="new_password2_confirmation" :type="show ? 'text' : 'password'"
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-gray-800"
                            placeholder="******" maxlength="6" inputmode="numeric">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-primary transition-colors z-10">
                            <span class="material-icons text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-end">
                    <button type="button" wire:click="changePassword2"
                        class="btn-tet font-black py-2.5 px-6 rounded-lg flex items-center gap-2 uppercase tracking-wide text-sm">
                        <span class="material-icons text-[20px]">lock_reset</span>
                        <span wire:loading.remove wire:target="changePassword2">Đổi mật khẩu cấp 2</span>
                        <span wire:loading wire:target="changePassword2" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Đang xử lý...
                        </span>
                    </button>
                </div>
            </div>
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-tet font-black py-2.5 px-6 rounded-lg flex items-center gap-2 uppercase tracking-wide">
                <span class="material-icons text-[20px]">save</span>
                <span wire:loading.remove>Lưu thay đổi</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Đang lưu...
                </span>
            </button>
        </div>
    </form>
</div>