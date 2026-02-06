<div>
    <div class="bg-gray-900 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-700">
            <h2 class="text-white text-lg font-bold">Tài khoản đã mua</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider border-b border-gray-700">
                        <th class="px-6 py-4">Mã đơn</th>
                        <th class="px-6 py-4">Sản phẩm</th>
                        <th class="px-6 py-4">Giá tiền</th>
                        <th class="px-6 py-4">Ngày mua</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($purchasedProducts as $order)
                    <tr class="text-sm text-gray-300 hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 font-mono font-medium text-gray-400">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">{{ $order->product->title ?? 'Sản phẩm đã xóa' }}</div>
                        </td>
                        <td class="px-6 py-4 font-bold text-green-400">
                            {{ number_format($order->final_amount) }}đ
                        </td>
                        <td class="px-6 py-4 text-gray-400">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($order->status == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-900/30 text-green-400 border border-green-700/50">Hoàn thành</span>
                            @elseif($order->status == 2)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-900/30 text-red-400 border border-red-700/50">Đã hủy</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-900/30 text-yellow-400 border border-yellow-700/50">Chờ xử lý</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="viewDetails({{ $order->id }})" class="text-primary-blue font-bold hover:underline hover:text-blue-400 transition-colors">Xem chi tiết</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-icons text-4xl text-gray-600">shopping_cart_off</span>
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
        <div class="p-4 border-t border-gray-700">
            {{ $purchasedProducts->links() }}
        </div>
        @endif

        <!-- Order Detail Modal -->
        @if($showModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            wire:click.self="closeModal">
            <div class="bg-white rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl animate-fade-in-up max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center sticky top-0 bg-white z-10">
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Tài khoản (Username)</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1 select-all" id="username-text">{{ $selectedOrder->product->username ?? 'N/A' }}</code>
                                    <button type="button" data-copy-text="{{ $selectedOrder->product->username ?? '' }}" class="copy-btn text-slate-400 hover:text-primary-blue active:text-primary-blue transition-all p-2 rounded-md hover:bg-primary-blue/10 active:bg-primary-blue/20 shrink-0 touch-manipulation">
                                        <span class="material-icons text-lg copy-icon">content_copy</span>
                                        <span class="material-icons text-lg check-icon hidden text-green-600">check_circle</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="bg-white p-3 rounded-lg border border-slate-200 hover:border-primary-blue/50 transition-colors group">
                                <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu cấp 1</span>
                                <div class="flex items-center justify-between gap-2">
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1 select-all" id="password-text">{{ $selectedOrder->product->password ?? 'N/A' }}</code>
                                    <button type="button" data-copy-text="{{ $selectedOrder->product->password ?? '' }}" class="copy-btn text-slate-400 hover:text-primary-blue active:text-primary-blue transition-all p-2 rounded-md hover:bg-primary-blue/10 active:bg-primary-blue/20 shrink-0 touch-manipulation">
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
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1 select-all" id="password2-text">{{ $selectedOrder->product->password2 }}</code>
                                    <button type="button" data-copy-text="{{ $selectedOrder->product->password2 }}" class="copy-btn text-slate-400 hover:text-primary-blue active:text-primary-blue transition-all p-2 rounded-md hover:bg-primary-blue/10 active:bg-primary-blue/20 shrink-0 touch-manipulation">
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
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1 select-all" id="email-text">{{ $selectedOrder->product->email }}</code>
                                    <button type="button" data-copy-text="{{ $selectedOrder->product->email }}" class="copy-btn text-slate-400 hover:text-primary-blue active:text-primary-blue transition-all p-2 rounded-md hover:bg-primary-blue/10 active:bg-primary-blue/20 shrink-0 touch-manipulation">
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
                                    <code class="font-mono font-bold text-slate-700 truncate flex-1 select-all" id="phone-text">{{ $selectedOrder->product->phone }}</code>
                                    <button type="button" data-copy-text="{{ $selectedOrder->product->phone }}" class="copy-btn text-slate-400 hover:text-primary-blue active:text-primary-blue transition-all p-2 rounded-md hover:bg-primary-blue/10 active:bg-primary-blue/20 shrink-0 touch-manipulation">
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

                <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-end sticky bottom-0 bg-white">
                    <button wire:click="closeModal" class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-lg transition touch-manipulation">
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
            const existingToast = document.getElementById('copy-toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.id = 'copy-toast';
            toast.className = `fixed top-4 right-4 left-4 md:left-auto md:right-4 z-[9999] px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in-right ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;

            toast.innerHTML = `
                <span class="material-icons text-xl">${type === 'success' ? 'check_circle' : 'error'}</span>
                <span class="font-medium">${message}</span>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slide-out-right 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Improved copy function that works on mobile
        function copyToClipboard(text, button) {
            if (!text || text === 'N/A' || text.trim() === '') {
                showToast('Không có dữ liệu để sao chép', 'error');
                return;
            }

            // Method 1: Modern Clipboard API (works on most modern browsers)
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text)
                    .then(() => {
                        handleCopySuccess(button);
                    })
                    .catch(() => {
                        // Fallback to Method 2
                        fallbackCopyTextToClipboard(text, button);
                    });
            } else {
                // Fallback for older browsers
                fallbackCopyTextToClipboard(text, button);
            }
        }

        // Fallback method using textarea (works better on mobile)
        function fallbackCopyTextToClipboard(text, button) {
            const textArea = document.createElement('textarea');
            textArea.value = text;

            // Prevent keyboard from showing on mobile
            textArea.style.position = 'fixed';
            textArea.style.top = '0';
            textArea.style.left = '0';
            textArea.style.width = '2em';
            textArea.style.height = '2em';
            textArea.style.padding = '0';
            textArea.style.border = 'none';
            textArea.style.outline = 'none';
            textArea.style.boxShadow = 'none';
            textArea.style.background = 'transparent';
            textArea.style.opacity = '0';
            textArea.style.pointerEvents = 'none';

            // Make it readonly to prevent mobile keyboard
            textArea.setAttribute('readonly', '');
            textArea.contentEditable = 'true';
            textArea.readOnly = false;

            document.body.appendChild(textArea);

            // For iOS devices
            if (navigator.userAgent.match(/ipad|iphone/i)) {
                const range = document.createRange();
                range.selectNodeContents(textArea);
                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
                textArea.setSelectionRange(0, 999999);
            } else {
                textArea.focus();
                textArea.select();
            }

            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    handleCopySuccess(button);
                } else {
                    showToast('Lỗi khi sao chép!', 'error');
                }
            } catch (err) {
                console.error('Fallback copy failed:', err);
                showToast('Lỗi khi sao chép!', 'error');
            }

            document.body.removeChild(textArea);
        }

        // Handle successful copy with visual feedback
        function handleCopySuccess(button) {
            showToast('Đã sao chép thành công!', 'success');

            if (button) {
                const copyIcon = button.querySelector('.copy-icon');
                const checkIcon = button.querySelector('.check-icon');

                if (copyIcon && checkIcon) {
                    copyIcon.classList.add('hidden');
                    checkIcon.classList.remove('hidden');

                    setTimeout(() => {
                        copyIcon.classList.remove('hidden');
                        checkIcon.classList.add('hidden');
                    }, 2000);
                }
            }
        }

        // Copy all credentials function
        function copyAllCredentials() {
            const credentials = [];
            const fields = [{
                    id: 'username-text',
                    label: 'Tài khoản'
                },
                {
                    id: 'password-text',
                    label: 'Mật khẩu cấp 1'
                },
                {
                    id: 'password2-text',
                    label: 'Mật khẩu cấp 2'
                },
                {
                    id: 'email-text',
                    label: 'Email'
                },
                {
                    id: 'phone-text',
                    label: 'Số điện thoại'
                }
            ];

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                if (element) {
                    const text = element.textContent.trim();
                    if (text && text !== 'N/A') {
                        credentials.push(`${field.label}: ${text}`);
                    }
                }
            });

            if (credentials.length === 0) {
                showToast('Không có thông tin để sao chép', 'error');
                return;
            }

            const allText = credentials.join('\n');
            const copyAllBtn = document.getElementById('copy-all-btn');

            // Use the same improved copy method
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(allText)
                    .then(() => {
                        showToast(`Đã sao chép ${credentials.length} thông tin!`, 'success');
                    })
                    .catch(() => {
                        fallbackCopyTextToClipboard(allText, copyAllBtn);
                    });
            } else {
                fallbackCopyTextToClipboard(allText, copyAllBtn);
            }
        }

        // Initialize event listeners
        function initializeCopyButtons() {
            // Remove existing listeners
            const oldHandler = window.copyClickHandler;
            if (oldHandler) {
                document.removeEventListener('click', oldHandler);
            }

            // Create new handler
            window.copyClickHandler = function(e) {
                const copyBtn = e.target.closest('.copy-btn');
                if (copyBtn) {
                    e.preventDefault();
                    e.stopPropagation();
                    const text = copyBtn.getAttribute('data-copy-text');
                    copyToClipboard(text, copyBtn);
                }
            };

            // Add event delegation for copy buttons
            document.addEventListener('click', window.copyClickHandler);

            // Handle copy all button
            const copyAllBtn = document.getElementById('copy-all-btn');
            if (copyAllBtn) {
                // Remove old listener if exists
                copyAllBtn.removeEventListener('click', copyAllCredentials);
                // Add new listener
                copyAllBtn.addEventListener('click', copyAllCredentials);
            }
        }

        // Initialize on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeCopyButtons);
        } else {
            initializeCopyButtons();
        }

        // Handle Livewire updates
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:load', function() {
                Livewire.hook('message.processed', (message, component) => {
                    setTimeout(initializeCopyButtons, 100);
                });
            });
        }

        // Alternative: Listen for Livewire's dom updates
        document.addEventListener('livewire:update', function() {
            setTimeout(initializeCopyButtons, 100);
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

        /* Improve touch targets on mobile */
        @media (max-width: 768px) {
            .copy-btn {
                min-width: 44px;
                min-height: 44px;
            }

            #copy-all-btn {
                min-height: 44px;
            }
        }

        /* Prevent text selection issues on mobile */
        .select-all {
            -webkit-user-select: all;
            -moz-user-select: all;
            -ms-user-select: all;
            user-select: all;
        }

        /* Better touch feedback */
        .touch-manipulation {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</div>