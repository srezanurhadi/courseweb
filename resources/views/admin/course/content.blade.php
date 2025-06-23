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
                            <h1 class="text-3xl font-bold text-gray-800">

                                <a href="{{ url()->previous() }}" class="hover:text-indigo-900">Course</a>

                                <i class="fa-solid fa-chevron-right mx-1 text-2xl"></i>

                                <a href="{{ route('user.course.show', [
                                    'course' => $course->slug,
                                    'from' => $from ?? 'course',
                                ]) }}"
                                    class="hover:text-indigo-900">
                                    {{ \Illuminate\Support\Str::limit($course->title, 15) }}
                                </a>

                                <i class="fa-solid fa-chevron-right mx-1 text-2xl"></i>

                                <span
                                    class="text-gray-600">{{ \Illuminate\Support\Str::limit($currentContent->title ?? 'Content 1', 15) }}</span>
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

            {{-- - Content Area - --}}
            <div class="max-w-6xl mx-auto py-4">
                <a href="{{ url()->previous() }}"
                    class="flex items-center text-indigo-700 hover:text-indigo-800 text-2xl font-bold pb-2 rounded-lg transition-colors gap-2">
                    <i class="fa-solid fa-caret-left text-4xl"></i>
                    Back
                </a>
                <div class="bg-gray-100 border-gray-200 border-2 rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $pagination['current_page'] }}.
                        {{ $course->title ?? 'Content 1' }}</h2>
                    @if (isset($editorJsData) && is_array($editorJsData['blocks']))
                        @foreach ($editorJsData['blocks'] as $block)
                            @switch ($block['type'])
                                @case('paragraph')
                                    {{-- Beri jarak bawah pada setiap paragraf --}}
                                    <p class="mb-4 text-gray-700 leading-relaxed">{!! $block['data']['text'] !!}</p>
                                @break

                                @case('header')
                                    @php
                                        $level = $block['data']['level'];
                                        $tag = 'h' . $level;
                                        // Atur ukuran dan jarak sesuai level heading
                                        $classes = [
                                            'h1' => 'text-4xl font-bold mt-8 mb-4',
                                            'h2' => 'text-3xl font-bold mt-8 mb-4 border-b pb-2',
                                            'h3' => 'text-2xl font-bold mt-6 mb-3',
                                            'h4' => 'text-xl font-bold mt-6 mb-3',
                                            'h5' => 'text-lg font-bold mt-4 mb-2',
                                            'h6' => 'text-base font-bold mt-4 mb-2',
                                        ];
                                    @endphp
                                    {{-- Terapkan class yang sesuai --}}
                                    <{!! $tag !!} class="{{ $classes[$tag] ?? '' }}">{!! $block['data']['text'] !!}
                                        </{!! $tag !!}>
                                    @break

                                    @case('image')
                                        <figure class="my-8"> {{-- Beri jarak atas/bawah yang lebih besar untuk gambar --}}
                                            <img src="{{ $block['data']['file']['url'] }}"
                                                alt="{{ $block['data']['caption'] ?? 'Image' }}"
                                                class="w-full h-auto rounded-lg shadow-md"> {{-- Gambar akan mengisi lebar kontainer --}}
                                            @if ($block['data']['caption'])
                                                <figcaption class="text-center text-sm text-gray-500 mt-2 italic">
                                                    {{ $block['data']['caption'] }}</figcaption>
                                            @endif
                                        </figure>
                                    @break

                                    @case('list')
                                        {{-- Beri style untuk list dan jarak antar item --}}
                                        @if ($block['data']['style'] === 'unordered')
                                            <ul class="list-disc pl-5 mb-4 space-y-2">
                                                @foreach ($block['data']['items'] as $item)
                                                    <li>{!! $item !!}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <ol class="list-decimal pl-5 mb-4 space-y-2">
                                                @foreach ($block['data']['items'] as $item)
                                                    <li>{!! $item !!}</li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    @break

                                    @case('quote')
                                        {{-- Buat blockquote menonjol --}}
                                        <blockquote class="my-6 p-4 border-l-4 border-gray-400 bg-gray-50 italic">
                                            <p class="text-xl font-medium leading-relaxed text-gray-800">
                                                {!! $block['data']['text'] !!}</p>
                                            @if ($block['data']['caption'])
                                                <footer class="mt-2 text-base text-gray-600">—
                                                    {{ $block['data']['caption'] }}</footer>
                                            @endif
                                        </blockquote>
                                    @break

                                    @case('delimiter')
                                        <hr class="my-8">
                                    @break

                                    {{-- Anda bisa menambahkan styling untuk 'code', 'table', dll. --}}
                                @endswitch
                        @endforeach
                    @else
                        <p class="text-gray-500 italic">Tidak ada konten yang tersedia.</p>
                    @endif
                </div>

                {{-- Updated Pagination Section --}}
                <div class="flex items-center justify-center gap-63 mt-8">
                    {{-- Previous Button --}}
                    @if ($pagination['has_previous'])
                        <a href="{{ route('user.course.content.show', [
                            'course' => $course->slug,
                            'content' => $pagination['previous_content_id'],
                            'from' => $from ?? 'course',
                        ]) }}"
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
                            <a href="{{ route('user.course.content.show', [
                                'course' => $course->slug,
                                'content' => $pagination['all_contents'][0]->id,
                                'from' => $from ?? 'course',
                            ]) }}"
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
                                <a href="{{ route('user.course.content.show', [
                                    'course' => $course->slug,
                                    'content' => $pagination['all_contents'][$i - 1]->id,
                                    'from' => $from ?? 'course',
                                ]) }}"
                                    class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors flex items-center justify-center">{{ $i }}</a>
                            @endif
                        @endfor

                        {{-- Show last page if not in range --}}
                        @if ($endPage < $totalPages)
                            @if ($endPage < $totalPages - 1)
                                <span
                                    class="w-6 h-6 text-indigo-700 rounded-lg font-medium flex items-center justify-center">...</span>
                            @endif
                            <a href="{{ route('user.course.content.show', [
                                'course' => $course->slug,
                                'content' => $pagination['all_contents'][$totalPages - 1]->id,
                                'from' => $from ?? 'course',
                            ]) }}"
                                class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors flex items-center justify-center">{{ $totalPages }}</a>
                        @endif
                    </div>

                    {{-- Next Button --}}
                    @if ($pagination['has_next'])
                        <a href="{{ route('user.course.content.show', [
                            'course' => $course->slug,
                            'content' => $pagination['next_content_id'],
                            'from' => $from ?? 'course',
                        ]) }}"
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
