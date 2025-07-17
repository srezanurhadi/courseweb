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
            <div class="w-full bg-gray-50 flex flex-col">
                <div
                    class="z-50 p-4 shadow-sm border-b border-gray-200 font-bold flex bg-gray-100 flex-row justify-between sticky top-0">
                    <div class="text-2xl font-bold pl-4 text-gray-800">Preview Course</div>
                    <div class="profile flex items-center gap-3 pr-4">
                        <i class="fas fa-bell text-xl text-gray-600 hover:text-indigo-600 cursor-pointer"></i>
                        <div class="rounded-full justify-center flex bg-gray-300 h-9 w-9 overflow-hidden">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                    class="aspect-square object-cover">
                            @else
                                <span class="text-lg font-medium">{{ Auth::user()->name[0] }}</span>
                            @endif
                        </div>
                        <div class="text-gray-700 font-medium">{{ Auth::User()->name }}</div>
                    </div>
                </div>
                {{-- breadcumb --}}
                <nav aria-label="Breadcrumb" role="navigation" class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <ul class="flex flex-wrap items-center">
                        <li class="inline-flex items-center">
                            <a href="https://eliteai.tools" aria-label="home"
                                class="inline-flex items-center font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                            <a href="https://eliteai.tools/category"
                                class="font-medium text-gray-500 hover:text-indigo-600 transition-colors">Categories</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                            <a href="https://eliteai.tools/category/design"
                                class="font-medium text-gray-500 hover:text-indigo-600 transition-colors">Design</a>
                        </li>
                        <li class="flex items-center" aria-current="page">
                            <svg class="w-4 h-4 mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                            <span class="font-medium text-gray-700">AI Web Designer</span>
                        </li>
                    </ul>
                </nav>
                {{-- breadcumb --}}

                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex gap-3 items-center">

                        <a href="/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Back to Courses</span>
                        </a>

                        <div class="flex gap-2 ml-auto">
                            <a href="/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}/edit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors duration-200">
                                <i class="fas fa-pencil-alt"></i>
                                <span>Edit Course</span>
                            </a>

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 rounded-lg transition-colors duration-200">
                                <i class="fas fa-trash"></i>
                                <span>Delete Course</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mx-6 mt-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="flex flex-row">
                            <div class="w-1/3 p-6">
                                <div class="aspect-video w-full rounded-lg overflow-hidden shadow-md">
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://picsum.photos/900/600?random=' . $course->id }}"
                                        alt="{{ $course->title }}" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div class="w-2/3 p-6 flex flex-col justify-between">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full">
                                            {{ $course->category->category }}
                                        </span>
                                        <div class="flex items-center gap-1 text-sm text-gray-600">
                                            <i class="fas fa-users text-indigo-600"></i>
                                            <span>{{ $course->enrollments_count }} Participants</span>
                                        </div>
                                    </div>

                                    @if ($course->status)
                                        <span
                                            class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                            Published
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-medium bg-rose-100 text-rose-700 rounded-full">
                                            Draft
                                        </span>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">
                                        {{ $course->title }}</h1>
                                    <p class="text-gray-600 text-base">
                                        <span class="font-medium">Course by:</span> {{ $course->user->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $orderedContents = $course->contents()->orderBy('course_contents.order')->get();
                    $firstContent = $orderedContents->first();
                @endphp
                <div class="mx-6 mb-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Content Section -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 h-fit">
                                <div class="p-6">
                                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-list-ul text-indigo-600"></i>
                                        Course Content
                                    </h2>
                                    <div class="space-y-2 max-h-80 overflow-y-auto">
                                        @foreach ($orderedContents as $index => $content)
                                            <a href="/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}/content/{{ $content->id }}"
                                                class="block p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 group">
                                                <div class="flex items-start gap-3">
                                                    <span
                                                        class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center text-sm font-medium">
                                                        {{ $index + 1 }}
                                                    </span>
                                                    <p
                                                        class="text-sm text-gray-700 group-hover:text-indigo-700 line-clamp-2 leading-relaxed">
                                                        {{ $content->title }}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 h-fit">
                                <div class="p-6">
                                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-info-circle text-indigo-600"></i>
                                        Course Description
                                    </h2>
                                    <div class="prose prose-gray max-w-none">
                                        <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
