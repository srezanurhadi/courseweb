<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - Admin Dashboard</title>
    <x-headcomponent></x-headcomponent>
</head>

<body class="">
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="container mx-auto flex flex-col gap-4">
            <!-- Header -->
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-10">
                <div class="text-3xl font-bold pl-4">Management Category</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8 overflow-hidden">

                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                class="aspect-square object-cover">
                        @else
                            <span class="text-xl">{{ Auth::user()->name[0] }}</span>
                        @endif

                    </div>
                    <div class="">{{ Auth::User()->name }}</div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="m-6 flex justify-between">
                <div class="relative w-2/5">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search categories..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        onkeyup="searchCategories()">
                </div>
                <button onclick="window.location.href='category/create'"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Create New Category
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mx-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-700 text-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Icon
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Color
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium"
                                        style="background-color: {{ $category->color }}20; color: {{ $category->color }};">
                                        {{ $category->category }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-md"
                                        style="background-color: {{ $category->color }}10;">
                                        <i class="{{ $category->icon }}" style="color: {{ $category->color }};"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full mr-3"
                                            style="background-color: {{ $category->color }};"></div>
                                        <span class="text-sm text-gray-900">{{ strtoupper($category->color) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="/{{ Auth::user()->role }}/{{ Request::is('*/mycontent*') ? 'mycontent' : 'content' }}/add/category/{{ $category->id }}/edit"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4 inline-flex items-center">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <form method="POST"
                                        action="/{{ Auth::user()->role }}/content/add/category/{{ $category->id }}"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 inline-flex items-center">
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <i class="fas fa-folder-open text-6xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No categories found</h3>
                                    <p class="text-gray-500">Get started by creating a new category.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($categories->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if ($categories->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                Previous
                            </span>
                        @else
                            <a href="{{ $categories->previousPageUrl() }}"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Previous
                            </a>
                        @endif

                        @if ($categories->hasMorePages())
                            <a href="{{ $categories->nextPageUrl() }}"
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Next
                            </a>
                        @else
                            <span
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                Next
                            </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ $categories->firstItem() }}</span> to
                                <span class="font-medium">{{ $categories->lastItem() }}</span> of
                                <span class="font-medium">{{ $categories->total() }}</span> results
                            </p>
                        </div>
                        <div>
                            {{ $categories->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div x-data="{
                    show: true,
                    progress: 100,
                    duration: 5000, // Durasi notifikasi dalam milidetik
                    intervalId: null,
                
                    // Fungsi untuk memulai timer dan progress bar
                    startTimer() {
                        // Hentikan timer sebelumnya jika ada (untuk keamanan)
                        clearInterval(this.intervalId);
                
                        const stepDuration = 10; // Update setiap 50ms untuk animasi mulus
                        const decrement = (stepDuration / this.duration) * 100;
                
                        this.intervalId = setInterval(() => {
                            this.progress -= decrement;
                
                            // Jika progress habis, tutup notifikasi
                            if (this.progress <= 0) {
                                this.close();
                            }
                        }, stepDuration);
                    },
                    close() {
                        this.show = false;
                        clearInterval(this.intervalId);
                    }
                }" x-init="startTimer()" x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4"
                    class="fixed top-5 right-5 z-50 rounded-lg bg-green-100 border-l-4 border-green-500 w-full max-w-sm p-4 shadow-lg"
                    role="alert">

                    <div class="flex items-start">
                        {{-- Icon --}}
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        {{-- Pesan --}}
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                        {{-- Tombol Close --}}
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button @click="close()" type="button"
                                    class="inline-flex rounded-md bg-green-100 p-1.5 text-green-500 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-100">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute bottom-0 left-0 right-0 h-1.5 bg-green-200/75 overflow-hidden rounded-bl-lg rounded-br-lg">
                        <div class="h-full bg-green-500" :style="{ width: progress + '%' }"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
