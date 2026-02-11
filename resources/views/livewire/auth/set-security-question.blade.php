<div>
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all scale-100 overflow-hidden border border-gray-200">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full border border-blue-200 mb-4">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-black text-primary mb-2 uppercase tracking-wide">
                    Câu hỏi bảo mật
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    Để bảo vệ tài khoản, vui lòng thiết lập câu hỏi bảo mật. Câu trả lời sẽ được dùng để xác thực khi bạn muốn thay đổi mật khẩu cấp 2.
                </p>

                @if(session()->has('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <form wire:submit.prevent="saveAnswer">
                    <div class="mb-4 text-left">
                        <label for="security_question" class="block text-sm font-bold text-gray-600 mb-1 uppercase tracking-wide">Chọn câu hỏi</label>
                        <select wire:model="selectedQuestionId" id="security_question"
                            class="w-full px-3 py-2 bg-white border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary rounded-md outline-none text-gray-800">
                            <option value="">-- Chọn câu hỏi --</option>
                            @foreach($questions as $q)
                            <option value="{{ $q['id'] }}">{{ $q['question'] }}</option>
                            @endforeach
                        </select>
                        @error('selectedQuestionId') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6 text-left">
                        <label for="security_answer" class="block text-sm font-bold text-gray-600 mb-1 uppercase tracking-wide">Câu trả lời</label>
                        <input type="text" wire:model="answer" id="security_answer"
                            class="w-full px-3 py-2 bg-white border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary rounded-md outline-none text-gray-800"
                            placeholder="Nhập câu trả lời của bạn...">
                        @error('answer') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="w-full btn-tet inline-flex justify-center rounded-md px-4 py-2 text-base font-black sm:text-sm transition-all duration-200 uppercase tracking-wide">
                        Xác nhận và Lưu
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>