<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Course - R. DOSEN</title>
    <x-headcomponent></x-headcomponent>
    <style>
        .enhanced-transition {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .enhanced-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- - Navbar - --}}
            <nav class="bg-white shadow-md z-50 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">My Course</h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-indigo-600"></i>
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
            <div class="relative flex-grow">
                @if (!$isFilteringOrSearching && $lastSeenCourse)
                    {{-- TAMPILAN HEADER BESAR (Jika tidak mencari & ada "Last Seen") --}}
                    <header
                        class="bg-indigo-100 h-auto rounded-b-3xl flex flex-col justify-center items-center relative overflow-hidden py-8 px-4">
                        <div class="bg-white rounded-3xl shadow-md py-3 px-5">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('user.mycourse.index') }}"
                                    class="flex items-center gap-2">
                                    <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 pl-2">
                                        <i class="fas fa-search text-gray-500"></i>
                                        <input type="text" name="search"
                                            class="rounded-lg w-48 focus:outline-none px-2 placeholder:font-semibold placeholder:italic text-gray-900"
                                            placeholder="Search Content..." value="{{ request('search') }}">
                                    </div>

                                    <button class="bg-sky-600 hover:bg-sky-700 px-2 rounded-3xl">
                                        <p class="font-medium text-base text-white cursor-pointer">Search</p>
                                    </button>

                                    @if (request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                </form>
                                <div class="w-[1px] h-[30px] bg-gray-300"></div>
                                <p class="flex items-center font-medium text-base text-gray-900 whitespace-nowrap">
                                    Choose Category :
                                </p>
                                <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 px-2">
                                    <i class="fas fa-search text-gray-500"></i>
                                    <select id="categoryFilterMyCourse"
                                        class="w-40 focus:outline-none px-2 text-gray-900 bg-transparent cursor-pointer">
                                        <option
                                            value="{{ route('user.mycourse.index', ['search' => request('search')]) }}"
                                            @if (!request('category')) selected @endif>
                                            All Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ route('user.mycourse.index', ['category' => $category->id, 'search' => request('search')]) }}"
                                                @if (request('category') == $category->id) selected @endif>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full max-w-6xl mt-6 mx-6">
                            <p class="text-indigo-700 text-2xl font-bold px-4 text-shadow-lg mb-2">Last Seen</p>
                            <a href="{{ route('user.course.show', ['course' => $lastSeenCourse->slug, 'from' => 'my-course']) }}"
                                class="block bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg p-6 hover:bg-white transition-all duration-300 enhanced-transition enhanced-card">
                                <div class="flex flex-row gap-6 items-center">
                                    <div class="w-1/3 h-40 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $lastSeenCourse->image) }}"
                                            alt="{{ $lastSeenCourse->title }}"
                                            class="w-full h-full object-cover rounded-xl shadow-md">
                                    </div>
                                    <div class="flex-1 flex flex-col">
                                        <div class="self-start w-auto">
                                            <div
                                                class="rounded-4xl bg-indigo-200 font-semibold py-1 px-2 text-xs text-indigo-700">
                                                {{ $lastSeenCourse->category->category }}
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-900 my-1">
                                            {{ $lastSeenCourse->title }}
                                        </h3>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-users-line text-indigo-700"></i>
                                            <div class="font-semibold text-gray-600">
                                                {{ $lastSeenCourse->enrollments_count }} Participant</div>
                                        </div>
                                        <div class="flex items-center space-x-1 my-1">
                                            <div
                                                class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                                {{ strtoupper(substr($lastSeenCourse->user->name, 0, 1)) }}
                                            </div>
                                            <div class="font-semibold text-gray-600">{{ $lastSeenCourse->user->name }}
                                            </div>
                                        </div>
                                        <p class="text-gray-600 line-clamp-3 mb-4">
                                            {{ \Illuminate\Support\Str::limit($lastSeenCourse->description, 70) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full"
                                                    style="width: {{ $lastSeenCourse->progress_percentage }}%">
                                                </div>
                                            </div>
                                            <span
                                                class="ml-4 text-sm font-medium text-gray-700">{{ $lastSeenCourse->progress_percentage }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </header>
                @else
                    {{-- TAMPILAN HEADER KECIL (Jika sedang mencari ATAU tidak ada kursus) --}}
                    <header
                        class="bg-indigo-100 h-[50px] rounded-b-3xl mb-4 flex justify-center items-center relative overflow-hidden">
                    </header>

                    <div class="absolute top-[25px] left-1/2 transform -translate-x-1/2">
                        <div class="bg-white rounded-3xl shadow-md py-3 px-5 flex items-center">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('user.mycourse.index') }}"
                                    class="flex items-center gap-2">
                                    <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 pl-2">
                                        <i class="fas fa-search text-gray-500"></i>
                                        <input type="text" name="search"
                                            class="rounded-lg w-48 focus:outline-none px-2 placeholder:font-semibold placeholder:italic text-gray-900"
                                            placeholder="Search Content..." value="{{ request('search') }}">
                                    </div>

                                    <button class="bg-sky-600 hover:bg-sky-700 px-2 rounded-3xl">
                                        <p class="font-medium text-base text-white cursor-pointer">Search</p>
                                    </button>

                                    @if (request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                </form>
                                <div class="w-[1px] h-[30px] bg-gray-300"></div>
                                <p class="flex items-center font-medium text-base text-gray-900 whitespace-nowrap">
                                    Choose Category :
                                </p>
                                <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 px-2">
                                    <i class="fas fa-search text-gray-500"></i>
                                    <select id="categoryFilterMyCourse"
                                        class="w-40 focus:outline-none px-2 text-gray-900 bg-transparent cursor-pointer">
                                        <option
                                            value="{{ route('user.mycourse.index', ['search' => request('search')]) }}"
                                            @if (!request('category')) selected @endif>
                                            All Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ route('user.mycourse.index', ['category' => $category->id, 'search' => request('search')]) }}"
                                                @if (request('category') == $category->id) selected @endif>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Konten Courses --}}
                <div class="min-h-[400px]">
                    @if ($courses->isEmpty() && !$lastSeenCourse)
                        <div class="col-span-full text-center py-15">
                            <p class="text-gray-500 text-lg">You are not enrolled in any courses yet.</p>
                            <p class="text-gray-400 text-sm">Explore a variety of exciting courses we offer and start
                                learning now.</p>
                            <a href="{{ route('user.course.index') }}" class="text-indigo-400 text-sm">View All
                                Courses</a>
                        </div>
                    @else
                        {{-- Grid Courses --}}
                        @if ($courses->count() > 0)
                            <div
                                class="mx-10 mt-10 mb-4 p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-around">
                                @foreach ($courses as $course)
                                    <div
                                        class="bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden h-105 enhanced-transition enhanced-card">

                                        {{-- Gambar Course --}}
                                        <a href="{{ route('user.course.show', ['course' => $course->slug, 'from' => 'my-course']) }}"
                                            class="w-full">
                                            <div class="p-2 h-40 w-full items-start flex justify-between bg-cover bg-center"
                                                style="background-image: url('{{ asset('storage/' . $course->image) }}')">

                                                <div
                                                    class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">
                                                    {{ $course->created_at->diffForHumans() }}
                                                </div>

                                                <div
                                                    class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">
                                                    {{ $course->contents_count }} Pages
                                                </div>
                                            </div>
                                        </a>

                                        <div class="h-full w-full p-2 flex flex-col mt-2">
                                            {{-- Kategori Course --}}
                                            <div class="self-start">
                                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900">
                                                    {{ $course->category->category }}
                                                </div>
                                            </div>

                                            {{-- Judul Course --}}
                                            <a href="{{ route('user.course.show', ['course' => $course->slug, 'from' => 'my-course']) }}"
                                                class="pl-2 pt-1 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                                {{ \Illuminate\Support\Str::limit($course->title, 40) }}
                                            </a>

                                            {{-- Deskripsi Course --}}
                                            <div class="pl-2 pt-1 text-sm text-gray-500 line-clamp-2 h-10">
                                                {{ \Illuminate\Support\Str::limit($course->description, 70) }}
                                            </div>

                                            <div class="flex-col space-y-2 m-2 mt-auto">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-users-line text-indigo-700"></i>
                                                    <div class="text-sm text-gray-600">
                                                        {{ $course->enrollments_count }} Participant</div>
                                                </div>

                                                <div class="flex items-center space-x-1">
                                                    <div
                                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                                        {{ strtoupper(substr($course->user->name, 0, 1)) }}
                                                    </div>
                                                    <div class="text-sm text-gray-600">{{ $course->user->name }}</div>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                                        <div class="bg-indigo-700 h-2 rounded-full"
                                                            style="width: {{ $course->progress_percentage }}%">
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="text-sm font-bold text-gray-900">{{ $course->progress_percentage }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                {{-- Pagination --}}
                @if ($courses->hasPages())
                    <div class="mb-4 px-10">
                        {{ $courses->withQueryString()->links() }}
                    </div>
                @endif
            </div>

            <x-footer></x-footer>
        </div>
    </div>

    <script>
        // Menunggu hingga seluruh konten halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {

            // Menemukan elemen dropdown kategori berdasarkan ID-nya
            const categoryFilter = document.getElementById('categoryFilterMyCourse');

            // Memastikan elemen dropdown tersebut ada di halaman ini
            if (categoryFilter) {

                // Menambahkan 'event listener' yang akan berjalan saat nilai dropdown berubah
                categoryFilter.addEventListener('change', function() {

                    // Mengambil URL dari <option> yang sedang dipilih
                    const selectedUrl = this.value;

                    // Mengarahkan browser ke URL yang dipilih tersebut
                    window.location.href = selectedUrl;
                });
            }
        });
    </script>

</body>

</html>
