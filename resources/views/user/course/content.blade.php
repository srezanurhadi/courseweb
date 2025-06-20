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
                                @if (isset($from) && $from == 'my-course')
                                    <a href="{{ route('user.mycourse.index') }}" class="hover:text-indigo-900">My
                                        Course</a>
                                @elseif (isset($from) && $from == 'history')
                                    <a href="{{ route('user.history') }}" class="hover:text-indigo-900">History</a>
                                @else
                                    <a href="{{ route('user.course.index') }}" class="hover:text-indigo-900">Course</a>
                                @endif

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
                        {{ $currentContent->title ?? 'Content 1' }}</h2>
                    <p class="text-gray-600 text-lg leading-relaxed text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit anim id est laborum. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <div class="flex justify-center my-6">
                        <div class="w-150 overflow-hidden">
                            <img src="https://picsum.photos/900/600" alt="Course Image"
                                class="w-full h-auto rounded-lg object-cover">
                            <p class="flex justify-center mt-1 text-gray-600 text-sm italic">
                                Fig.{{ $pagination['current_page'] }} Lorem picsum</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit anim id est laborum. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
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
            <x-footer></x-footer>
        </div>
    </div>
</body>

</html>
