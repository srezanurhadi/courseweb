<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="flex-1">
            {{-- - Navbar - --}}
            <nav class="bg-white shadow-md z-50 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-xl font-bold text-gray-800">

                                <a href="/admin{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}"
                                    class="hover:text-indigo-900">Preview Course</a>

                            </h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xl font-semibold leading-none text-gray-700">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </span>
                                <span class="text-xl font-semibold text-gray-700">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            {{-- breadcumb --}}
            <nav aria-label="Breadcrumb" role="navigation" class="bg-white px-6 py-3 ">
                <ul class="flex flex-wrap items-center">
                    <li class="inline-flex items-center">
                        <a href="/{{ Auth::user()->role }}" aria-label="home"
                            class="inline-flex items-center font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                            </path>
                        </svg>
                        <a href="/admin{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}"
                            class="font-medium text-gray-500 hover:text-indigo-600 transition-colors">Course</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                            </path>
                        </svg>
                        <a href="/admin{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}"
                            class="font-medium text-gray-500 hover:text-indigo-600 transition-colors">{{ Str::limit($course->title, 20) }}

                        </a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                            </path>
                        </svg>
                        <span class="font-medium text-gray-700">{{ $currentContent->title }}</span>
                    </li>
                </ul>
            </nav>
            {{-- breadcumb --}}
            {{-- - Content Area - --}}
            <div class="max-w-6xl mx-auto p-4">
                <a href="{{ url()->previous() }}"
                    class="flex items-center text-indigo-700 hover:text-indigo-800 text-2xl font-bold pb-2 rounded-lg transition-colors gap-2">
                    <i class="fa-solid fa-caret-left text-2xl"></i>
                    Back
                </a>

                <div class="bg-gray-100 border-gray-200 border-2 rounded-xl shadow-lg p-8 m-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $pagination['current_page'] }}.
                        {{ $currentContent->title ?? 'Content 1' }}</h2>
                    <div class="max-w-3xl mx-auto">
                        @if (isset($editorJsData) && is_array($editorJsData['blocks']))
                            @foreach ($editorJsData['blocks'] as $block)
                                @switch ($block['type'])
                                    @case('paragraph')
                                        @php
                                            $alignment = $block['data']['alignment'] ?? 'left';
                                            $alignmentClass =
                                                [
                                                    'left' => 'text-left',
                                                    'center' => 'text-center',
                                                    'right' => 'text-right',
                                                    'justify' => 'text-justify',
                                                ][$alignment] ?? 'text-left';
                                        @endphp
                                        <p class="mb-4 text-gray-700 leading-relaxed {{ $alignmentClass }}">
                                            {!! $block['data']['text'] !!}</p>
                                    @break

                                    @case('header')
                                        @php
                                            $level = $block['data']['level'] ?? 2;
                                            $tag = 'h' . $level;
                                            $classes = [
                                                1 => 'text-4xl font-bold mt-8 mb-4',
                                                2 => 'text-3xl font-bold mt-8 mb-4 border-b pb-2',
                                                3 => 'text-2xl font-bold mt-6 mb-3',
                                                4 => 'text-xl font-bold mt-6 mb-3',
                                                5 => 'text-lg font-bold mt-4 mb-2',
                                                6 => 'text-base font-bold mt-4 mb-2',
                                            ];
                                        @endphp
                                        <{{ $tag }} class="{{ $classes[$level] ?? '' }}">
                                            {!! $block['data']['text'] !!}
                                            </{{ $tag }}>
                                        @break

                                        @case('image')
                                            @php
                                                $isStretched = $block['data']['stretched'] ?? false;
                                                $hasBorder = $block['data']['withBorder'] ?? false;
                                                $hasBackground = $block['data']['withBackground'] ?? false;
                                                $figureClasses = [
                                                    'my-8',
                                                    'mx-auto',
                                                    'rounded-lg',
                                                    'overflow-hidden',
                                                    'shadow-md',
                                                    $isStretched ? 'w-full' : 'max-w-full lg:w-5/6',
                                                    $hasBorder ? 'border-2 border-slate-800' : 'border-none',
                                                    $hasBackground ? 'p-4 sm:p-6 bg-slate-100' : '',
                                                ];
                                            @endphp
                                            <figure class="{{ implode(' ', array_filter($figureClasses)) }}">
                                                <img src="{{ $block['data']['file']['url'] }}"
                                                    alt="{{ $block['data']['caption'] ?? 'Image' }}"
                                                    class="w-full h-full object-cover">
                                                @if (!empty($block['data']['caption']))
                                                    <figcaption class="text-center text-sm text-gray-500 mt-2 italic">
                                                        {{ $block['data']['caption'] }}
                                                    </figcaption>
                                                @endif
                                            </figure>
                                        @break

                                        {{-- BLOK LIST YANG SUDAH DIPERBAIKI --}}
                                        @case('list')
                                            @php
                                                $listStyle = $block['data']['style'] ?? 'unordered';
                                                $tag = $listStyle === 'ordered' ? 'ol' : 'ul';
                                                $class = $listStyle === 'ordered' ? 'list-decimal' : 'list-disc';

                                                // ----> 1. TAMBAHKAN BARIS INI <----
                                                // Ambil nomor awal, jika tidak ada, default ke 1
                                                $startNumber = $block['data']['meta']['start'] ?? 1;
                                            @endphp

                                            {{-- ----> 2. MODIFIKASI BARIS INI <---- --}}
                                            {{-- Tambahkan atribut 'start' HANYA jika ini adalah ordered list (<ol>) --}}
                                            <{{ $tag }} class="{{ $class }} pl-5 mb-4 space-y-2"
                                                @if ($tag === 'ol') start="{{ $startNumber }}" @endif>
                                                @foreach ($block['data']['items'] as $item)
                                                    @include('partials._list_item', ['item' => $item])
                                                @endforeach
                                                </{{ $tag }}>
                                            @break

                                            {{-- AKHIR BLOK LIST --}}
                                            @case('quote')
                                                <blockquote class="my-6 p-4 border-l-4 border-gray-400 bg-gray-50 italic">
                                                    <p class="text-xl font-medium leading-relaxed text-gray-800">
                                                        {!! $block['data']['text'] !!}</p>
                                                    @if (!empty($block['data']['caption']))
                                                        <footer class="mt-2 text-base text-gray-600">—
                                                            {{ $block['data']['caption'] }}</footer>
                                                    @endif
                                                </blockquote>
                                            @break

                                            @case('delimiter')
                                                <hr class="my-8">
                                            @break

                                            @case('code')
                                                <pre class="bg-gray-800 text-white text-sm rounded-lg p-4 my-6 overflow-x-auto"><code class="font-mono">{!! htmlspecialchars($block['data']['code']) !!}</code></pre>
                                            @break

                                            @case('table')
                                                @php
                                                    $withHeadings = $block['data']['withHeadings'] ?? false;
                                                    $content = $block['data']['content'];
                                                    $header =
                                                        $withHeadings && count($content) > 0
                                                            ? array_shift($content)
                                                            : null;
                                                    $body = $content;
                                                @endphp
                                                <div class="my-6 overflow-x-auto">
                                                    <table class="min-w-full border border-gray-300">
                                                        @if ($header)
                                                            <thead class="bg-gray-100">
                                                                <tr>
                                                                    @foreach ($header as $cell)
                                                                        <th
                                                                            class="p-3 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">
                                                                            {!! $cell !!}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                        @endif
                                                        <tbody>
                                                            @foreach ($body as $row)
                                                                <tr class="hover:bg-gray-50">
                                                                    @foreach ($row as $cell)
                                                                        <td class="p-3 border-b border-gray-300 text-gray-700">
                                                                            {!! $cell !!}</td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @break
                                        @endswitch
                            @endforeach
                        @else
                            <p class="text-gray-500 italic">Tidak ada konten yang tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Updated Pagination Section --}}
                <div class="flex items-center justify-center gap-63 mt-8">
                    {{-- Previous Button --}}
                    @if ($pagination['has_previous'])
                        <a href="/{{ Auth::user()->role }}/mycourse/{{ $course->slug }}/content/{{ $pagination['previous_content_id'] }}"
                            class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                            Previous
                        </a>
                    @else
                        <button disabled
                            class="bg-gray-400 text-white font-semibold px-6 py-2 rounded-lg cursor-not-allowed">
                            Previous
                        </button>
                    @endif

                    {{-- Page Numbers --}}
                    <div class="flex items-center gap-2">
                        @php
                            $totalPages = $pagination['total_pages'];
                            $currentPage = $pagination['current_page'];
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);
                        @endphp

                        {{-- Show first page if not in range --}}
                        @if ($startPage > 1)
                            <a href="/{{ Auth::user()->role }}/mycourse/{{ $course->slug }}/content/{{ $pagination['all_contents'][0]->id }}"
                                class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors flex items-center justify-center">1</a>
                            @if ($startPage > 2)
                                <span
                                    class="w-6 h-6 text-indigo-700 rounded-lg font-medium flex items-center justify-center">...</span>
                            @endif
                        @endif

                        {{-- Show page range --}}
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            @if ($i == $currentPage)
                                <button
                                    class="w-6 h-6 bg-indigo-700 text-white rounded-lg font-medium">{{ $i }}</button>
                            @else
                                <a href="/{{ Auth::user()->role }}/mycourse/{{ $course->slug }}/content/{{ $pagination['all_contents'][$i - 1]->id }}"
                                    class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors flex items-center justify-center">{{ $i }}</a>
                            @endif
                        @endfor

                        {{-- Show last page if not in range --}}
                        @if ($endPage < $totalPages)
                            @if ($endPage < $totalPages - 1)
                                <span
                                    class="w-6 h-6 text-indigo-700 rounded-lg font-medium flex items-center justify-center">...</span>
                            @endif
                            <a href="/{{ Auth::user()->role }}/mycourse/{{ $course->slug }}/content/{{ $pagination['all_contents'][$totalPages - 1]->id }}"
                                class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors flex items-center justify-center">{{ $totalPages }}</a>
                        @endif
                    </div>

                    {{-- Next Button --}}
                    @if ($pagination['has_next'])
                        <a href="/{{ Auth::user()->role }}/mycourse/{{ $course->slug }}/content/{{ $pagination['next_content_id'] }}"
                            class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="bg-gray-400 text-white font-semibold px-6 py-2 rounded-lg cursor-not-allowed">
                            Next
                        </button>
                    @endif
                </div>
            </div>
            <div class="relative">
            </div>
        </div>
    </div>
</body>

</html>
