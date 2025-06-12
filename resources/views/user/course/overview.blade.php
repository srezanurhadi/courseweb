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
                            </h1>
                        </div>
                        <div class="flex
                                    items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        {{-- Jika user punya foto, tampilkan foto --}}
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" 
                                            alt="{{ Auth::user()->name }}" 
                                            class="w-full h-full object-cover">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan inisial --}}
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
            <div class="relative">
                <header class="bg-indigo-100 px-6 py-8">
                    <div class="max-w-6xl mx-auto">

                        <div class="flex flex-row gap-6">
                            <!-- Course Image -->
                            <div class="w-80 h-full bg-gray-300 rounded-xl flex items-center justify-center">
                                <img src="https://picsum.photos/900/600" alt="Course Image"
                                    class="w-full h-full object-cover rounded-xl">

                            </div>

                            <!-- Course Info -->
                            <div class="flex-1">
                                <span
                                    class="inline-block bg-indigo-200 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    Web Development
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900 mb-4">Tutorial Laravel 12 100% work no debat
                                    dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                    lain</h1>
                                <p class="text-gray-600 mb-3 leading-relaxed">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.
                                </p>

                                <!-- Progress Bar -->
                                <div class="flex items-center gap-4">
                                    <div class="flex-1 bg-gray-300 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 50%"></div>
                                    </div>
                                    <span class="text-xl font-bold text-gray-900">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Main Content Area -->
                <div class="max-w-6xl mx-auto py-8">
                    <div class="grid grid-cols-3 gap-10">
                        <!-- Content Sidebar -->
                        <div class="col-span-1">
                            <div class="bg-gray-100 shadow-lg rounded-xl p-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Content</h3>
                                <ul class="">
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">1. Content
                                            1</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">2. Content
                                            2</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">3. Content
                                            3</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">4. Content
                                            4</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">5. Content
                                            5</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                    <li class="flex items-center justify-between py-2">
                                        <a href="{{ route('user.course.content') }}"
                                            class="text-gray-700 hover:text-indigo-800 font-semibold text-xl">6. Content
                                            6</a>
                                        <i
                                            class="far fa-square text-gray-400 text-2xl checklist-icon cursor-pointer"></i>
                                    </li>
                                </ul>
                            </div>
                            <button
                                class="w-full mt-6 bg-indigo-100 hover:bg-indigo-300 text-gray-700 font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-users"></i>
                                Discussion Group
                            </button>
                        </div>

                        <!-- Main Content -->
                        <div class="col-span-2">
                            <div class="bg-gray-100 rounded-xl shadow-lg p-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Why Do We Choose Laravel?</h2>
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
                                </div>

                                <button
                                    class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
    <script>
        const checklistIcons = document.querySelectorAll('.checklist-icon');

        checklistIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                if (this.classList.contains('fa-square')) {
                    this.classList.remove('fa-square');
                    this.classList.remove('text-gray-400');

                    this.classList.add('fa-check-square');
                    this.classList.add('text-indigo-700');
                } else if (this.classList.contains('fa-check-square')) {
                    this.classList.remove('fa-check-square'); // Hapus kelas ikon tercentang
                    this.classList.remove('text-indigo-700'); // Hapus warna biru

                    this.classList.add('fa-square'); // Tambah kelas ikon kosong
                    this.classList.add('text-gray-400'); // Tambah warna abu-abu
                }
            });
        });
    </script>
</body>

</html>
