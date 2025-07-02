<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail - R. DOSEN</title>
    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="h-screen flex">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 h-full w-64">
            <x-sidebar></x-sidebar>
        </div>

        <!-- Main content -->
        <div class="flex-grow flex flex-col pl-54">
            <!-- Navbar -->
            <nav class="bg-white shadow-md z-10 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">
                                <a href="{{ route('user.profile') }}" class="hover:text-indigo-900">My Profile</a>
                                <i class="fa-solid fa-chevron-right mx-1 text-2xl"></i>
                                <a href="{{ route('user.profile.edit') }}" class="hover:text-indigo-900">Detail</a>
                            </h1>
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
                <!-- Grade Section -->
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl bg-white rounded-md border border-gray-300 shadow-md p-8 text-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Grade - {{ $course->title ?? 'Course' }}</h2>
                        <p class="text-lg text-gray-600 mb-6">Congratulations on completing this class!</p>
                        <p class="text-lg text-gray-600 mb-2">Your grades are:</p>
                        <div class="text-8xl font-bold text-indigo-700 mb-8">98</div>

                        <!-- Certificate Preview Section -->
                        <div class="mb-8">
                            <p class="text-lg text-gray-600 mb-4">Download the certificate below!</p>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 mb-4">
                                <!-- Placeholder for certificate image -->
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/certificate-placeholder.jpg') }}"
                                        alt="Certificate Preview" class="max-w-full h-auto shadow-md">
                                </div>
                            </div>
                        </div>

                        <button
                            class="bg-indigo-700 text-white rounded-md px-6 py-2 text-lg font-semibold hover:bg-indigo-800 transition-colors">
                            Download Certificate
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
