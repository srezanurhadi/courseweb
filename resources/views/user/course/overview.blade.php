<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \Illuminate\Support\Str::limit($course->title, 10) }}- R. DOSEN</title>
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

                                {{-- Bagian ini tetap sama, menampilkan judul kursus --}}
                                <span
                                    class="text-gray-600">{{ \Illuminate\Support\Str::limit($course->title, 15) }}</span>
                            </h1>
                        </div>
                        <div class="flex
                                    items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        {{-- Jika user punya foto, tampilkan foto --}}
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
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

                        <div class="flex flex-row items-center gap-6">
                            <!-- Course Image -->
                            <div class="w-80 h-full bg-gray-300 rounded-xl flex items-center justify-center">
                                <img src="https://picsum.photos/900/600" alt="Course Image"
                                    class="w-full h-full object-cover rounded-xl">

                            </div>

                            <!-- Course Info -->
                            <div class="flex-1">
                                <span
                                    class="inline-block bg-indigo-200 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    {{ $course->category->category }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                                <span class="text-gray-900 mb-2">By: {{ $course->user->name }}</span>
                                <!-- Progress Bar -->
                                @if ($isEnrolled)
                                    <div class="flex items-center gap-4">
                                        <div class="flex-1 bg-gray-300 rounded-full h-3 mr-3">
                                            <div class="bg-indigo-700 h-3 rounded-full"
                                                style="width: {{ $progressPercentage }}%"></div>
                                        </div>
                                        <span class="text-xl font-bold text-gray-900">{{ $progressPercentage }}%</span>
                                    </div>
                                @elseif (!$isEnrolled)
                                    <div class="flex flex-col ">
                                        <p class="text-gray-500 mt-2">Not started yet...</p>
                                        <div class="flex flex-row items-center gap-4">
                                            <div class="flex-1 bg-gray-300 rounded-full h-3 mr-3">
                                                <div class="bg-indigo-700 h-3 rounded-full"
                                                    style="width: {{ $progressPercentage }}%"></div>
                                            </div>
                                            <span
                                                class="text-xl font-bold text-gray-900">{{ $progressPercentage }}%</span>
                                        </div>
                                    </div>
                                @endif
                                {{-- enrollmernt start --}}
                                <div class="flex-1">
                                    @if (session('success'))
                                        <div class="bg-green-50 border border-green-700 text-green-700 px-4 py-3 rounded relative my-4"
                                            role="alert">
                                            <strong class="font-bold">Sukses!</strong>
                                            <span class="block sm:inline">{{ session('success') }}</span>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="bg-red-100 border border-red-700 text-red-700 px-4 py-3 rounded relative my-4"
                                            role="alert">
                                            <strong class="font-bold">Gagal!</strong>
                                            <span class="block sm:inline">{{ session('error') }}</span>
                                        </div>
                                    @endif

                                    @if ($isEnrolled)
                                        {{-- Jika SUDAH terdaftar, tampilkan tombol Unenroll --}}
                                        <form action="{{ route('user.course.unenroll', $course->slug) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin berhenti dari kursus ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="h-8 w-full mt-4 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center gap-2">
                                                <i class="fas fa-times-circle"></i>
                                                Unenroll From Course
                                            </button>
                                        </form>
                                    @else
                                        {{-- Jika BELUM terdaftar, tampilkan tombol Enroll --}}
                                        <form action="{{ route('user.course.enroll', $course->slug) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="h-8 w-full mt-4 bg-indigo-700 hover:bg-indigo-800 text-white font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center gap-2">
                                                <i class="fas fa-plus"></i>
                                                Enroll This Course
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                {{-- enrollmernt end --}}
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Main Content Area -->
                <div class="max-w-6xl mx-auto py-8">
                    <div class="grid grid-cols-3 gap-10">
                        <!-- Content Sidebar -->
                        <div class="col-span-1">
                            <div class="bg-gray-100 shadow-lg rounded-xl p-6 relative">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Content</h3>
                                {{-- limited content --}}
                                <ul class="">
                                    @if ($isEnrolled)
                                        {{-- JIKA SUDAH ENROLL: Tampilkan semua konten --}}
                                        @forelse($allContents as $content)
                                            @if (in_array($content->id, $completedContentIds))
                                                {{-- JIKA SUDAH SELESAI: Tampilkan ikon tercentang dan teks berwarna --}}
                                                <li class="flex items-center justify-between py-2 ">
                                                    <a href="{{ route('user.course.content.show', ['course' => $course->slug, 'content' => $content->id, 'from' => $from ?? 'course']) }}"
                                                        class="text-indigo-800 hover:text-indigo-700 font-semibold text-xl pr-2">
                                                        {{ $loop->iteration }}. {{ $content->title }}
                                                    </a>
                                                    <i class="fas fa-check-square text-indigo-700 text-2xl"></i>
                                                </li>
                                            @else
                                                {{-- JIKA BELUM SELESAI: Tampilkan seperti biasa --}}
                                                <li class="flex items-center justify-between py-2">
                                                    <a href="{{ route('user.course.content.show', ['course' => $course->slug, 'content' => $content->id, 'from' => $from ?? 'course']) }}"
                                                        class="text-gray-700 hover:text-indigo-800 font-semibold text-xl pr-2">
                                                        {{ $loop->iteration }}. {{ $content->title }}
                                                    </a>
                                                    <i class="far fa-square text-gray-400 text-2xl"></i>
                                                </li>
                                            @endif
                                        @empty
                                            <li class="text-gray-500">Content Unavailable.</li>
                                        @endforelse
                                    @else
                                        {{-- JIKA BELUM ENROLL: Tampilkan konten lock --}}
                                        @forelse($limitedContents as $content)
                                            <li class="flex items-center justify-between py-2">
                                                <a href="#"
                                                    class="text-gray-700 font-semibold text-xl cursor-not-allowed">
                                                    {{ $loop->iteration }}. {{ $content->title }}
                                                </a>
                                                <i class="fa-solid fa-lock text-gray-400 text-xl"></i>
                                            </li>
                                        @empty
                                            <li class="text-gray-500">Content Unavailable.</li>
                                        @endforelse
                                    @endif
                                </ul>
                                {{-- gradient kotak content --}}
                                @if (!$isEnrolled && $allContents->count() > 1)
                                    <div
                                        class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-gray-100 from-40% to-transparent rounded-b-xl pointer-events-none">
                                    </div>

                                    <div class="absolute bottom-6 left-0 w-full text-center px-6 pointer-events-none">
                                        <p class="text-xl font-semibold text-gray-800 ">
                                            Enroll to access all content!
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <button
                                class="text-xl w-full mt-6 bg-indigo-100 hover:bg-indigo-300 text-gray-700 font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-lg">
                                <i class="fas fa-users"></i>
                                Discussion Group
                            </button>
                        </div>

                        <!-- Main Content -->
                        <div class="col-span-2">
                            <div class="bg-gray-100 rounded-xl shadow-lg p-6 h-full">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Description</h2>
                                <p class="text-gray-600 text-lg leading-relaxed text-justify">
                                    {{ $course->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</body>

</html>
