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
                class="p-4 shadow-[0px_0px_4px_1px_rgba(0,0,0,0.4)] font-bold flex bg-gray-100 flex-row justify-between sticky top-0">
                <div class="text-3xl font-bold pl-4">Management Course</div>
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
            <div class="w-full flex pt-6 pb-2 px-6 justify-between">
                <div class="flex gap-4">
                    <form action="/{{ Auth::user()->role }}{{ Request::is('*/mycourse') ? '/mycourse' : '/course' }}"
                        method="GET" class="flex gap-2">
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic"
                                placeholder="Search Course...">
                        </div>
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                            <i class="fas fa-filter text-gray-500"></i>
                            <select name="category" id="category"
                                class="min-w-56 focus:outline-none px-2 text-gray-900" onchange="this.form.submit()">

                                <option value="" {{ request('category') ? ' ' : 'selected' }}>All Category
                                </option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach`
                            </select>
                        </div>
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                            <i class="fas fa-filter text-gray-500"></i>
                            <select name="status" onchange="this.form.submit()">
                                <option value="">Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Published
                                </option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <button class="bg-sky-600 px-2 rounded-lg">
                            <p class=" font-medium text-base text-white">search</p>
                        </button>
                    </form>


                </div>
                <div class="">
                    <a href="/{{ Auth::user()->role }}{{ Request::is('*/mycourse') ? '/mycourse/create' : '/course/create' }}"
                        class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
                            class="fas fa-plus text-gray-50"></i> Add Course</a>
                </div>

            </div>
            <div class="p-4 flex flex-cols-3 justify-around gap-4">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">All Course</div>
                        <div class="text-3xl text-indigo-700">{{ $coursescount }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-200 h-10 w-10 m-4">
                        <i class="fas fa-book text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col  font-semibold ">
                        <div class="text-base text-gray-800">Active Course</div>
                        <div class="text-3xl text-green-700 pl-4">{{ $coursesactive }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-check text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Drafted Course</div>
                        <div class="text-3xl text-amber-500 pl-4">{{ $coursesdraft }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-pencil text-2xl text-amber-500"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-around">
                @foreach ($courses as $course)
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div class="p-2 h-52 w-full items-start flex justify-between  bg-cover bg-center "
                            style="background-image: url('{{ $course->image ? asset('storage/' . $course->image) : 'https://picsum.photos/900/600?random=' . $course->id }}');">

                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-gray-900">
                                {{ $course->created_at->diffForHumans() }}
                            </div>
                            @if ($course->status)
                                <div class="rounded-4xl bg-green-600 py-1 px-2 text-xs text-gray-200">Published
                                </div>
                            @else
                                <div class="rounded-4xl bg-red-600 py-1 px-2 text-xs text-gray-200">Draft
                                </div>
                            @endif
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col justify-around mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl font-bold bg-indigo-200 py-1 px-2 text-xs text-gray-900 self-start"
                                    style="background-color: {{ $course->category->color }}20; color: {{ $course->category->color }}; ">
                                    {{ $course->category->category }}
                                </div>
                                <div class="relative inline-block text-left">
                                    <div>
                                        <button type="button"
                                            class="js-dropdown-button inline-flex justify-center w-full rounded-md p-2 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                            aria-haspopup="true" aria-expanded="true">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="dropdown-menu"
                                        class="js-dropdown-menu hidden origin-top-right absolute shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] right-0 mt-2 w-56 rounded-md bg-gray-100 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                                        <div class="" role="none">
                                            <a href="/admin{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}/edit"
                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
                                                role="menuitem" id="menu-item-0">Edit Course</a>
                                            <a href="/admin{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}"
                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
                                                role="menuitem" id="menu-item-1">Show more</a>
                                            <form action="/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}" method="POST"
                                                class="delete-btn text-rose-700 block px-4 py-2 text-sm hover:bg-rose-300 hover:text-red-900 hover:cursor-pointer"
                                                data-title="{{ $course->title }}">
                                                @csrf
                                                @method('DELETE')
                                                {{-- PERUBAHAN DI SINI --}}
                                                <div class="font-medium">
                                                    Hapus
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:cursor-pointer"
                                onclick="window.location.href='/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}/{{ $course->slug }}'">
                                {{ $course->title }}</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">
                                {{ $course->description }}</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        {{ substr($course->user->name, 0, 1) }}</div>
                                    <div class="pl-2 text-sm text-gray-600">{{ $course->user->name }}</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">{{ $course->enrollments_count }} Participant
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="mt-4 pb-4">
                {{ $courses->appends(request()->all())->links() }}
            </div>
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
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
            <div id="delete-confirmation-modal"
                class="fixed ml-54 inset-0 z-[100] flex items-center justify-center bg-white/10 backdrop-blur-sm bg-opacity-50 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
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
                                        Apakah Anda yakin ingin menghapus konten
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
</body>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const allDropdownButtons = document.querySelectorAll('.js-dropdown-button');


        allDropdownButtons.forEach(button => {
            button.addEventListener('click', (event) => {

                event.stopPropagation();
                const dropdownContainer = button.closest('.relative');
                const dropdownMenu = dropdownContainer.querySelector('.js-dropdown-menu');


                const isMenuOpen = !dropdownMenu.classList.contains('hidden');


                document.querySelectorAll('.js-dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });

                if (!isMenuOpen) {
                    dropdownMenu.classList.remove('hidden');
                }

            });
        });

        window.addEventListener('click', () => {
            document.querySelectorAll('.js-dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

    });

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
            contentTitleElement.textContent = `'${title}'`;

            modal.classList.remove('pointer-events-none');

            setTimeout(() => {
                // Tambahkan kelas untuk memicu animasi 'fade in' dan 'scale up'
                modal.classList.add('opacity-100', 'scale-100');
                modal.classList.remove('opacity-0', 'scale-95');
            }, 10); // Jeda 10 milidetik sudah cukup
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

</html>
