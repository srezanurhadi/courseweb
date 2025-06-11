@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center   ">
        {{-- Kiri: Teks Informasi --}}
        <div class="">
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        {{-- Kanan: Link Halaman --}}
        <div class="flex justify-center ">
            <div class="flex items-center space-x-1">
                {{-- Tombol "Previous" (Tetap sama) --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center justify-center w-10 h-10 text-gray-400 cursor-default" aria-disabled="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center justify-center w-10 h-10 text-gray-600 transition duration-150 ease-in-out rounded-md hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @endif

                {{-- ================================================== --}}
                {{-- ▼▼▼ LOGIKA NOMOR HALAMAN YANG BARU ▼▼▼ --}}
                {{-- ================================================== --}}

                @php
                    $startRange = 1;
                    $endRange = min(3, $paginator->lastPage());
                @endphp
                
                {{-- Tampilkan halaman 1, 2, 3 --}}
                @for ($i = $startRange; $i <= $endRange; $i++)
                    @if ($i == $paginator->currentPage())
                        {{-- Tombol Aktif --}}
                        <span class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-blue-600 rounded-md cursor-default" aria-current="page">{{ $i }}</span>
                    @else
                        {{-- Tombol Normal --}}
                        <a href="{{ $paginator->url($i) }}" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-600 transition duration-150 ease-in-out rounded-md hover:bg-blue-50">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Tampilkan "..." jika perlu --}}
                @if ($paginator->lastPage() > 4)
                    <span class="relative inline-flex items-center justify-center w-10 h-10 text-gray-500 cursor-default">...</span>
                @endif

                {{-- Tampilkan halaman terakhir jika lebih dari 3 halaman --}}
                @if ($paginator->lastPage() > 3)
                    @if ($paginator->lastPage() == $paginator->currentPage())
                        {{-- Tombol Aktif --}}
                         <span class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-blue-600 rounded-md cursor-default" aria-current="page">{{ $paginator->lastPage() }}</span>
                    @else
                        {{-- Tombol Normal --}}
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-600 transition duration-150 ease-in-out rounded-md hover:bg-blue-50">{{ $paginator->lastPage() }}</a>
                    @endif
                @endif

                {{-- ================================================== --}}
                {{-- ▲▲▲ AKHIR DARI LOGIKA NOMOR HALAMAN BARU ▲▲▲ --}}
                {{-- ================================================== --}}

                {{-- Tombol "Next" (Tetap sama) --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center justify-center w-10 h-10 text-gray-600 transition duration-150 ease-in-out rounded-md hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @else
                    <span class="relative inline-flex items-center justify-center w-10 h-10 text-gray-400 cursor-default" aria-disabled="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif