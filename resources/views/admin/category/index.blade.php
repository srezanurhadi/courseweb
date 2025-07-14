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
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn text-red-600 hover:text-red-900 inline-flex items-center"
                                            data-title="{{ $category->category }}">

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

            @foreach (['success', 'error'] as $type)
                @if (session($type))
                    <div x-data="{
                        show: true,
                        progress: 100,
                        duration: 5000,
                        intervalId: null,
                        startTimer() {
                            clearInterval(this.intervalId);
                            const stepDuration = 10;
                            const decrement = (stepDuration / this.duration) * 100;
                    
                            this.intervalId = setInterval(() => {
                                this.progress -= decrement;
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
                        class="fixed top-5 right-5 z-50 rounded-lg w-full max-w-sm p-4 shadow-lg
                {{ $type == 'success' ? 'bg-green-100 border-l-4 border-green-500' : 'bg-red-100 border-l-4 border-red-500' }}"
                        role="alert">

                        <div class="flex items-start">
                            {{-- Icon --}}
                            <div class="flex-shrink-0">
                                @if ($type == 'success')
                                    {{-- Success Icon --}}
                                    <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @else
                                    {{-- Error Icon --}}
                                    <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-8 3a1 1 0 100-2 1 1 0 000 2zm-.707-7.707a1 1 0 011.414 0L10 6.586l.293-.293a1 1 0 011.414 1.414L11.414 8l.293.293a1 1 0 01-1.414 1.414L10 9.414l-.293.293a1 1 0 01-1.414-1.414L8.586 8l-.293-.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>

                            {{-- Pesan --}}
                            <div class="ml-3 flex-1">
                                <p
                                    class="text-sm font-medium {{ $type == 'success' ? 'text-green-800' : 'text-red-800' }}">
                                    {{ session($type) }}
                                </p>
                            </div>

                            {{-- Tombol Close --}}
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button @click="close()" type="button"
                                        class="inline-flex rounded-md p-1.5 
                                {{ $type == 'success' ? 'bg-green-100 text-green-500 hover:bg-green-200 focus:ring-green-600 focus:ring-offset-green-100' : 'bg-red-100 text-red-500 hover:bg-red-200 focus:ring-red-600 focus:ring-offset-red-100' }}
                                focus:outline-none focus:ring-2 focus:ring-offset-2">
                                        <span class="sr-only">Dismiss</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Progress bar --}}
                        <div
                            class="absolute bottom-0 left-0 right-0 h-1.5 
                {{ $type == 'success' ? 'bg-green-200/75' : 'bg-red-200/75' }} overflow-hidden rounded-bl-lg rounded-br-lg">
                            <div class="h-full {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }}"
                                :style="{ width: progress + '%' }"></div>
                        </div>
                    </div>
                @endif
            @endforeach


            <div id="delete-confirmation-modal"
                class="fixed inset-0 ml-54 z-49 flex items-center justify-center bg-white/10 backdrop-blur-sm bg-opacity-50 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-4 text-left">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    Konfirmasi Hapus
                                </h3>
                                <div class="mt-2">
                                    {{-- PERUBAHAN DI SINI --}}
                                    <p class="text-sm text-gray-600">
                                        Apakah Anda yakin ingin menghapus Category
                                        <strong id="content-title-to-delete" class="text-gray-900"></strong>?
                                        <br>Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                        {{-- Tombol tidak berubah --}}
                        <button type="button" id="confirmDeleteBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Hapus
                        </button>
                        <button type="button" id="cancelDeleteBtn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-confirmation-modal');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const contentTitleElement = document.getElementById('content-title-to-delete');

            let formToSubmit = null;

            // Fungsi untuk menampilkan modal dengan transisi
            const showModal = (form, title) => {
                formToSubmit = form;
                contentTitleElement.textContent = title; // fix
                modal.classList.remove('pointer-events-none');

                setTimeout(() => {
                    modal.classList.add('opacity-100', 'scale-100');
                    modal.classList.remove('opacity-0', 'scale-95');
                }, 10);
            };


            // Fungsi untuk menyembunyikan modal dengan transisi
            const hideModal = () => {
                // 1. Tambahkan kelas untuk memicu animasi 'fade out' dan 'scale down'
                modal.classList.remove('opacity-100', 'scale-100');
                modal.classList.add('opacity-0', 'scale-95');

                // 2. Setelah animasi selesai (300ms), buat modal tidak bisa diklik lagi
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    formToSubmit = null;
                    contentTitleElement.textContent = '';
                }, 300);
            };

            // Tambahkan event listener untuk setiap tombol hapus
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {

                    event.preventDefault();

                    const form = this.closest('form');
                    const title = this.dataset.title;
                    showModal(form, title);
                });
            });

            // Event listener untuk tombol konfirmasi
            confirmDeleteBtn.addEventListener('click', () => {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });

            // Event listener untuk tombol batal
            cancelDeleteBtn.addEventListener('click', hideModal);

            // Event listener untuk menutup modal jika klik di area luar (backdrop)
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    hideModal();
                }
            });
        });
    </script>

</body>

</html>
