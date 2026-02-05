<div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200">
            <h2 class="text-slate-900 text-lg font-bold">Tài khoản đã mua</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Mã đơn</th>
                        <th class="px-6 py-4">Sản phẩm</th>
                        <th class="px-6 py-4">Giá tiền</th>
                        <th class="px-6 py-4">Ngày mua</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($purchasedProducts as $order)
                    <tr class="text-sm">
                        <td class="px-6 py-4 font-mono font-medium text-slate-600">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $order->product->title ?? 'Sản phẩm đã xóa' }}</div>
                        </td>
                        <td class="px-6 py-4 font-bold text-primary-blue">
                            {{ number_format($order->final_amount) }}đ
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($order->status == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">Hoàn thành</span>
                            @elseif($order->status == 2)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Đã hủy</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Chờ xử lý</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="viewDetails({{ $order->id }})" class="text-primary-blue font-bold hover:underline">Xem chi tiết</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-icons text-4xl text-slate-300">shopping_cart_off</span>
                                <p>Bạn chưa mua tài khoản nào</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($purchasedProducts->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $purchasedProducts->links() }}
        </div>
        @endif

        <!-- Order Detail Modal -->
        @if($showModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            wire:click.self="closeModal">
            <div class="bg-white rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl animate-fade-in-up">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-slate-900">Chi tiết đơn hàng #{{ $selectedOrder->order_number }}</h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600">
                        <span class="material-icons">close</span>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Product Info -->
                    <div class="flex gap-4">
                        <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0 border border-slate-200">
                            <img src="{{ url('storage/'.$selectedOrder->product->images[0] ?? '') }}"
                                alt="{{ $selectedOrder->product->title ?? 'Sản phẩm' }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">{{ $selectedOrder->product->title ?? 'Sản phẩm đã xóa' }}</h4>
                            <div class="flex items-center gap-4 text-sm text-slate-500">
                                <div>
                                    Giá gốc: <span class="line-through">{{ number_format($selectedOrder->product_price) }}đ</span>
                                </div>
                                <div class="text-accent-red font-bold">
                                    Thành tiền: {{ number_format($selectedOrder->final_amount) }}đ
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Credentials (Important) -->
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                        <h4 class="font-bold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="material-icons text-primary-blue">vpn_key</span>
                            Thông tin tài khoản:
                        </h4>

                        @if(!$isVerified)
                        <!-- Verification Form -->
                        <div class="bg-white p-6 rounded-lg border border-slate-200 text-center">
                            <div class="max-w-xs mx-auto space-y-4">
                                <div class="w-12 h-12 bg-primary-blue/10 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <span class="material-icons text-primary-blue">lock</span>
                                </div>
                                <h5 class="font-bold text-slate-800">Yêu cầu xác thực</h5>
                                <p class="text-xs text-slate-500">Vui lòng nhập <b>Mật khẩu cấp 2</b> để xem thông tin tài khoản này.</p>

                                <div class="relative">
                                    <input type="password"
                                        wire:model="inputPassword2"
                                        wire:keydown.enter="verifyPassword"
                                        placeholder="Nhập mật khẩu cấp 2..."
                                        class="w-full px-4 py-2 rounded-lg border @error('inputPassword2') border-red-500 @else border-slate-200 @enderror focus:ring-2 focus:ring-primary-blue/20 outline-none text-center font-mono">
                                    @error('inputPassword2')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button wire:click="verifyPassword"
                                    wire:loading.attr="disabled"
                                    class="w-full py-2 bg-primary-blue hover:bg-primary-blue/90 text-white font-bold rounded-lg transition-all flex items-center justify-center gap-2">
                                    <span wire:loading.remove class="text-green-600">Xác nhận</span>
                                    <span wire:loading class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                </button>

                                <p class="text-[11px] text-slate-400 italic">
                                    Ghi chú: Sử dụng Mật khẩu 2 để lấy thông tin tài khoản.
                                </p>
                            </div>
                        </div>
                        @else
                        <!-- Revealed Credentials -->

                        <!-- Copy All Button -->
                        <div class="mb-4 flex justify-end">
                            <button id="copy-all-btn" class="inline-flex items-center gap-2 px-4 py-2 bg-linear-to-r from-primary-blue to-blue-600 hover:from-blue-600 hover:to-primary-blue text-white font-bold rounded-lg transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                                <span class="material-icons text-lg">content_copy</span>
                                <span>Sao chép tất cả</span>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Tài khoản (Username)</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1" id="username-text">{{ $selectedOrder->product->username ?? 'N/A' }}</code>
                                    <button data-copy-text="{{ $selectedOrder->product->username ?? '' }}" class="copy-btn text-slate-400 hover:text-primary-blue transition-all p-1.5 rounded-md hover:bg-primary-blue/10 shrink-0">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu cấp 1</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1" id="password-text">{{ $selectedOrder->product->password ?? 'N/A' }}</code>
                                    <button data-copy-text="{{ $selectedOrder->product->password ?? '' }}" class="copy-btn text-slate-400 hover:text-primary-blue transition-all p-1.5 rounded-md hover:bg-primary-blue/10 shrink-0">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Password 2 -->
                            @if(!empty($selectedOrder->product->password2))
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu cấp 2</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1" id="password2-text">{{ $selectedOrder->product->password2 }}</code>
                                    <button data-copy-text="{{ $selectedOrder->product->password2 }}" class="copy-btn text-slate-400 hover:text-primary-blue transition-all p-1.5 rounded-md hover:bg-primary-blue/10 shrink-0">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>
                            @endif

                            <!-- Email -->
                            @if(!empty($selectedOrder->product->email))
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Email</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1" id="email-text">{{ $selectedOrder->product->email }}</code>
                                    <button data-copy-text="{{ $selectedOrder->product->email }}" class="copy-btn text-slate-400 hover:text-primary-blue transition-all p-1.5 rounded-md hover:bg-primary-blue/10 shrink-0">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>
                            @endif

                            <!-- Phone -->
                            @if(!empty($selectedOrder->product->phone))
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Số điện thoại</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1" id="phone-text">{{ $selectedOrder->product->phone }}</code>
                                    <button data-copy-text="{{ $selectedOrder->product->phone }}" class="copy-btn text-slate-400 hover:text-primary-blue transition-all p-1.5 rounded-md hover:bg-primary-blue/10 shrink-0">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if(isset($selectedOrder->product->note))
                        <div class="mt-4 pt-4 border-t border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Ghi chú</span>
                            <p class="text-sm text-slate-700">{{ $selectedOrder->product->note }}</p>
                        </div>
                        @endif

                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100 italic text-[13px] text-blue-700">
                            <span class="font-bold">Ghi chú:</span> Sử dụng Mật khẩu 2 để lấy thông tin tài khoản trong trang quản lý đơn hàng
                        </div>
                        @endif
                    </div>

                    <!-- Transaction Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-slate-500 block">Thời gian mua:</span>
                            <span class="font-medium">{{ $selectedOrder->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block">Trạng thái:</span>
                            @if($selectedOrder->status == 1)
                            <span class="text-green-600 font-bold">Hoàn thành</span>
                            @else
                            <span class="text-yellow-600 font-bold">Chờ xử lý</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-end">
                    <button wire:click="closeModal" class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-lg transition">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Toast notification function
        function showToast(message, type = 'success') {
            // Remove existing toast if any
            const existingToast = document.getElementById('copy-toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.id = 'copy-toast';
            toast.className = `fixed top-4 right-4 z-[9999] px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in-right ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;

            toast.innerHTML = `
        <span class="material-icons text-xl">${type === 'success' ? 'check_circle' : 'error'}</span>
        <span class="font-medium">${message}</span>
    `;

            document.body.appendChild(toast);

            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slide-out-right 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Copy to clipboard function with visual feedback
        function copyToClipboard(text, button) {
            if (!text || text === 'N/A') {
                showToast('Không có dữ liệu để sao chép', 'error');
                return;
            }

            navigator.clipboard.writeText(text).then(() => {
                // Show success toast
                showToast('Đã sao chép thành công!', 'success');

                // Toggle icon animation
                const copyIcon = button.querySelector('.copy-icon');
                const checkIcon = button.querySelector('.check-icon');

                if (copyIcon && checkIcon) {
                    copyIcon.classList.add('hidden');
                    checkIcon.classList.remove('hidden');

                    // Reset icon after 2 seconds
                    setTimeout(() => {
                        copyIcon.classList.remove('hidden');
                        checkIcon.classList.add('hidden');
                    }, 2000);
                }
            }).catch(err => {
                showToast('Lỗi khi sao chép!', 'error');
                console.error('Copy failed:', err);
            });
        }

        // Copy all credentials function
        function copyAllCredentials() {
            const credentials = [];

            // Get username
            const username = document.getElementById('username-text')?.textContent.trim();
            if (username && username !== 'N/A') {
                credentials.push(`Tài khoản: ${username}`);
            }

            // Get password
            const password = document.getElementById('password-text')?.textContent.trim();
            if (password && password !== 'N/A') {
                credentials.push(`Mật khẩu cấp 1: ${password}`);
            }

            // Get password2
            const password2 = document.getElementById('password2-text')?.textContent.trim();
            if (password2 && password2 !== 'N/A') {
                credentials.push(`Mật khẩu cấp 2: ${password2}`);
            }

            // Get email
            const email = document.getElementById('email-text')?.textContent.trim();
            if (email && email !== 'N/A') {
                credentials.push(`Email: ${email}`);
            }

            // Get phone
            const phone = document.getElementById('phone-text')?.textContent.trim();
            if (phone && phone !== 'N/A') {
                credentials.push(`Số điện thoại: ${phone}`);
            }

            if (credentials.length === 0) {
                showToast('Không có thông tin để sao chép', 'error');
                return;
            }

            const allText = credentials.join('\n');

            navigator.clipboard.writeText(allText).then(() => {
                showToast(`Đã sao chép ${credentials.length} thông tin!`, 'success');
            }).catch(err => {
                showToast('Lỗi khi sao chép!', 'error');
                console.error('Copy all failed:', err);
            });
        }

        // Event delegation for copy buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Handle individual copy buttons
            document.addEventListener('click', function(e) {
                const copyBtn = e.target.closest('.copy-btn');
                if (copyBtn) {
                    const text = copyBtn.getAttribute('data-copy-text');
                    copyToClipboard(text, copyBtn);
                }
            });

            // Handle copy all button
            const copyAllBtn = document.getElementById('copy-all-btn');
            if (copyAllBtn) {
                copyAllBtn.addEventListener('click', copyAllCredentials);
            }
        });

        // Also handle Livewire updates (when modal is re-rendered)
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                const copyAllBtn = document.getElementById('copy-all-btn');
                if (copyAllBtn) {
                    copyAllBtn.removeEventListener('click', copyAllCredentials);
                    copyAllBtn.addEventListener('click', copyAllCredentials);
                }
            });
        });
    </script>

    <style>
        @keyframes slide-in-right {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-out-right {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.3s ease-out;
        }

        @keyframes fade-in-up {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.3s ease-out;
        }
    </style>
</div>