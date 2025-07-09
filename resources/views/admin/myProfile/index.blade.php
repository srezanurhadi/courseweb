<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile - R. DOSEN</title>
    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="h-screen flex">
        <!-- Sidebar dengan fixed position -->
        <div class="fixed top-0 left-0 h-full w-64">
            <x-sidebar></x-sidebar>
        </div>

        <!-- Konten utama dengan padding-left untuk mengkompensasi sidebar -->
        <div class="flex-grow flex flex-col pl-54"> <!-- pl-64 harus sama dengan lebar sidebar -->
            <!-- Navbar -->
            <nav class="bg-white shadow-md z-10 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
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

            <main class="flex-grow p-6 bg-gray-100">
                <!-- Profile Section -->
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl">
                        <!-- Profile Title positioned outside section but aligned with content -->
                        <div class="mb-2">
                            <h2 class="text-xl font-bold text-gray-800">Profile</h2>
                        </div>

                        {{-- Tampilkan pesan sukses jika ada dengan auto hide --}}
                        @if (session('success'))
                            <div id="success-message"
                                class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md transition-opacity duration-500">
                                {{ session('success') }}
                            </div>
                        @endif

                        <section class="mb-8 rounded-md border border-gray-300 shadow-md bg-white">
                            <!-- Profile content -->
                            <div class="p-4 lg:p-6 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                <!-- Profile Form -->
                                <div class="flex-1 w-full">
                                    <form class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full max-w-2xl">
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="fullname">Full
                                                Name</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="fullname" type="text" value="{{ $user->name }}" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="email">Email</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="email" type="email" value="{{ $user->email }}"readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="handphone">Handphone</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="handphone" type="text" value="{{ $user->no_telp }}" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="role">Role</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="role" type="text" value="{{ $user->role }}" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="joindate">Join
                                                Date</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="joindate" type="text"
                                                value="{{ $user->created_at->format('Y') }}" readonly />
                                        </div>

                                        <div class="col-span-full mt-4">
                                            <a href="/{{ Auth::user()->role }}/myprofile/{{ $user->name }}/edit"
                                                class="text-indigo-700 border border-indigo-700 rounded-md px-8 py-2 text-sm font-semibold hover:bg-indigo-700 hover:text-white transition-colors">Edit</a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Profile Photo Section - Now on the right side -->
                                <div class="flex flex-col items-center gap-4 lg:w-1/3 order-first lg:order-last">
                                    <div class="relative">
                                        <input type="file" id="image" name="image" class="hidden"
                                            accept="image/*">

                                        <div id="image-container"
                                            class="w-32 h-32 sm:w-54 sm:h-54 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden">
                                            @if ($user->image)
                                                {{-- Jika pengguna punya gambar, tampilkan gambar tersebut --}}
                                                <img id="image-preview" src="{{ asset('storage/' . $user->image) }}"
                                                    alt="{{ $user->name }}" class="w-full h-full object-cover">
                                            @else
                                                {{-- Jika tidak, tampilkan preview dari file yg baru dipilih (awalnya kosong) --}}
                                                <img id="image-preview" src="#" alt="Image Preview"
                                                    class="w-full h-full object-cover hidden">
                                                {{-- Dan tampilkan inisial sebagai default --}}
                                                <span id="initials-preview"
                                                    class="text-3xl sm:text-4xl font-semibold text-indigo-700">
                                                    @php
                                                        $words = explode(' ', $user->name);
                                                        $initials = strtoupper(substr($words[0], 0, 1));
                                                        if (isset($words[1])) {
                                                            $initials .= strtoupper(substr($words[1], 0, 1));
                                                        }
                                                    @endphp
                                                    {{ $initials }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ ucwords($user->name) }}
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ ucfirst($user->name) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl">
                        <div class="mb-2 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">Course Created </h2>
                            <div class="text-gray-600 font-semibold tex">
                                Total Courses Created: {{ $totalCourses }}
                            </div>
                        </div>
                        <div
                            class="bg-indigo-100  p-2 rounded-lg border-2 border-indigo-300 overflow-y-auto h-100 course-created-scrollable">
                            <ul class="space-y-2 w-full">
                                @foreach ($createdCourses as $createdCourse)
                                    <li class=" rounded-md py-3 px-6 flex justify-between items-center shadow-sm"
                                        style="background-color: {{ $createdCourse->category->color }}20;">
                                        <div class="flex overflow-hidden items-center gap-1">
                                            <div class="flex-shrink-0 h-8 w-8 mr-4 rounded-md bg-amber-400 flex items-center justify-center text-white"
                                                style="background-color:{{ $createdCourse->category->color }};">
                                                <i class="{{ $createdCourse->category->icon }}"></i>
                                            </div>
                                            <span class="truncate min-w-0" title="">
                                                {{ $createdCourse->title }}
                                            </span>
                                        </div>
                                        <div>
                                            <span
                                                class="text-sm text-gray-800 mr-2">{{ $createdCourse->enrollments_count }}
                                                Participant</span>
                                            <span class="text-sm text-gray-800">{{ $createdCourse->contents_count }}
                                                Content</span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- JavaScript untuk auto hide success message --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                // Hilangkan pesan setelah 4 detik (4000ms)
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    // Hapus element setelah animasi selesai
                    setTimeout(function() {
                        successMessage.remove();
                    }, 500); // 500ms untuk durasi transition opacity
                }, 4000); // 4 detik
            }
        });
    </script>
</body>

</html>
