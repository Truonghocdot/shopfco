{{-- Popup Modal Component --}}
@inject('viewDataService', 'App\Services\ViewDataService')

@php
$popupContentResult = $viewDataService->getPopupContent();
$popupContent = $popupContentResult->isSuccess() ? $popupContentResult->getData() : null;
@endphp

@if($popupContent)
<div id="popup-modal" class="fixed inset-0 z-9999 hidden items-center justify-center p-4 bg-black/50">
    <div class="relative max-w-2xl w-full">
        <!-- Modal Content -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary to-orange-500 p-4 flex justify-between items-center">
                <h3 class="text-xl font-black uppercase text-white flex items-center gap-2">
                    <span class="material-icons">campaign</span>
                    THÔNG BÁO
                </h3>
                <button onclick="closePopup()" class="text-white/80 hover:text-white transition-colors">
                    <span class="material-icons">close</span>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6 max-h-[60vh] overflow-y-auto prose prose-primary max-w-none">
                {!! $popupContent !!}
            </div>

            <!-- Footer with Duration Options -->
            <div class="bg-gray-50 p-4 border-t border-gray-100">
                <p class="text-sm text-gray-500 mb-3 font-bold">Ẩn thông báo này trong:</p>
                <div class="flex gap-3">
                    <button onclick="closePopup(1)" class="flex-1 bg-white hover:bg-gray-50 border border-gray-200 text-primary px-4 py-2 rounded-lg font-bold transition-all active:scale-95">
                        <span class="material-icons text-sm align-middle mr-1">schedule</span>
                        1 Giờ
                    </button>
                    <button onclick="closePopup(24)" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-bold transition-all active:scale-95">
                        <span class="material-icons text-sm align-middle mr-1">event</span>
                        24 Giờ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function shouldShowPopup() {
        const hideUntil = localStorage.getItem('popup_hide_until');
        if (!hideUntil) return true;
        return new Date() > new Date(hideUntil);
    }

    function closePopup(hours = 0) {
        const modal = document.getElementById('popup-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (hours > 0) {
            const hideUntil = new Date();
            hideUntil.setHours(hideUntil.getHours() + hours);
            localStorage.setItem('popup_hide_until', hideUntil.toISOString());
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (shouldShowPopup()) {
            const modal = document.getElementById('popup-modal');
            setTimeout(() => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }, 1000);
        }
    });

    document.getElementById('popup-modal')?.addEventListener('click', function(e) {
        if (e.target === this) closePopup();
    });
</script>

<style>
    .prose-primary {
        color: #333;
    }

    .prose-primary h1,
    .prose-primary h2,
    .prose-primary h3,
    .prose-primary h4 {
        color: #D42020;
    }

    .prose-primary a {
        color: #D42020;
        text-decoration: underline;
    }

    .prose-primary strong {
        color: #D42020;
    }
</style>
@endif