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
                                <a href="{{ route('user.course.index') }}" class="hover:text-indigo-900">Course</a>
                                <i class="fa-solid fa-chevron-right mx-1 text-2xl"></i>
                                <a href="{{ route('user.course.overview') }}" class="hover:text-indigo-900">Title</a>
                                <i class="fa-solid fa-chevron-right mx-1 text-2xl"></i>
                                <a href="{{ route('user.course.content') }}" class="hover:text-indigo-900">Content 1</a>
                            </h1>
                        </div>
                        <div class="flex
                                    items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300">
                                    <span class="text-xl font-semibold leading-none text-gray-700">A</span>
                                </span>
                                <span class="text-xl font-semibold text-gray-700">User</span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- - Content Area - --}}
            <div class="max-w-6xl mx-auto py-4">
                <a href="{{ route('user.course.overview') }}"
                    class="flex items-center text-indigo-700 hover:text-indigo-800 text-2xl font-bold pb-2 rounded-lg transition-colors gap-2">
                    <i class="fa-solid fa-caret-left text-4xl"></i>
                    Back
                </a>
                <div class="bg-gray-100 border-gray-200 border-2 rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Content 1</h2>
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
                            <p class="flex justify-center mt-1 text-gray-600 text-sm italic">Fig.1 Lorem picsum</p>
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
                <div class="flex items-center justify-center gap-63 mt-8">
                    <button
                        class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                        Previous
                    </button>

                    <div class="flex items-center gap-2">
                        <button class="w-6 h-6 bg-indigo-700 text-white rounded-lg font-medium">1</button>
                        <button
                            class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">2</button>
                        <button
                            class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">3</button>
                        <button
                            class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">...</button>
                        <button
                            class="w-6 h-6 text-indigo-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">10</button>
                    </div>

                    <button
                        class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                        Next
                    </button>
                </div>
            </div>
            <div class="relative">
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</body>

</html>
