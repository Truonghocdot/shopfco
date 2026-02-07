@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col gap-4">
    {{-- Mobile: Show page numbers in a compact grid --}}
    <div class="sm:hidden">
        <div class="flex items-center justify-center gap-2 flex-wrap mb-3">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-bold text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default leading-5 rounded-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-black text-primary bg-black/40 border-2 border-primary/50 leading-5 rounded-lg hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
            @if (is_string($element))
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-black text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default leading-5 rounded-lg">{{ $element }}</span>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-black text-black bg-gradient-to-r from-primary to-green-400 border-2 border-primary cursor-default leading-5 rounded-lg shadow-[0_0_20px_rgba(0,255,0,0.5)]">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="relative inline-flex items-center px-3 py-2 text-sm font-black text-primary bg-black/40 border-2 border-primary/50 leading-5 rounded-lg hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-black text-primary bg-black/40 border-2 border-primary/50 leading-5 rounded-lg hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            @else
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-bold text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default leading-5 rounded-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
            @endif
        </div>

        {{-- Mobile: Show result count --}}
        <p class="text-xs text-center text-slate-400 leading-5 font-bold">
            Hiển thị <span class="font-black text-primary">{{ $paginator->firstItem() }}</span> - <span class="font-black text-primary">{{ $paginator->lastItem() }}</span> / <span class="font-black text-primary">{{ $paginator->total() }}</span>
        </p>
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-400 leading-5 font-bold">
                Hiển thị
                <span class="font-black text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">{{ $paginator->firstItem() }}</span>
                đến
                <span class="font-black text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">{{ $paginator->lastItem() }}</span>
                trong tổng số
                <span class="font-black text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">{{ $paginator->total() }}</span>
                kết quả
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-lg">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="Trang trước">
                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-black text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default rounded-l-lg leading-5" aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-black text-primary bg-black/40 border-2 border-primary/50 rounded-l-lg leading-5 hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all" aria-label="Trang trước">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <span aria-disabled="true">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-black text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default leading-5">{{ $element }}</span>
                </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span aria-current="page">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-black text-black bg-gradient-to-r from-primary to-green-400 border-2 border-primary cursor-default leading-5 shadow-[0_0_20px_rgba(0,255,0,0.5)]">{{ $page }}</span>
                </span>
                @else
                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-black text-primary bg-black/40 border-2 border-primary/50 leading-5 hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all" aria-label="Trang {{ $page }}">
                    {{ $page }}
                </a>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-black text-primary bg-black/40 border-2 border-primary/50 rounded-r-lg leading-5 hover:bg-primary/10 hover:shadow-[0_0_15px_rgba(0,255,0,0.3)] transition-all" aria-label="Trang sau">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                @else
                <span aria-disabled="true" aria-label="Trang sau">
                    <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-black text-slate-600 bg-black/40 border-2 border-slate-700 cursor-default rounded-r-lg leading-5" aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif