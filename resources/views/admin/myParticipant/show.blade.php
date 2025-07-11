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
    <div class="flex flex-1 h-screen"> {{-- Ditambahkan h-screen untuk memastikan flex container mengisi tinggi layar --}}
        <x-sidebar></x-sidebar>
        <div class="w-full bg-gray-50 relative h-full overflow-y-auto">

            {{-- Header yang Sticky --}}
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-30">
                <div class="text-3xl font-bold pl-4">My Participant</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            {{-- search --}}
            <div class="w-full flex gap-4 pt-8 pb-4 px-4 justify-center">
                <div class="flex gap-4">
                    <form class="flex gap-2" method="GET">
                        <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic bg-transparent"
                                placeholder="Search User Name...">
                        </div>
                        <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                            <i class="fas fa-filter text-gray-500"></i>
                            <select name="status" class="bg-transparent focus:outline-none">
                                <option value="">Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Finished
                                </option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ongoing</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-sky-600 px-2 rounded-lg">
                            <p class="font-medium text-base text-white">Search</p>
                        </button>

                        {{-- Reset button --}}
                        @if (request('search') || request('status'))
                            <a href="{{ url()->current() }}" class="bg-gray-500 px-2 rounded-lg flex items-center">
                                <p class="font-medium text-base text-white">Reset</p>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            {{-- head --}}
            <div class="p-4 flex justify-between gap-8">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Total Course</div>
                        <div class="text-3xl text-indigo-700 pl-4">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                        <i class="fas fa-users text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Total Participant</div>
                        <div class="text-3xl text-green-700 pl-4">20</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-user text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Avg. Participant</div>
                        <div class="text-3xl text-amber-500 pl-4">15</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-user-tie text-2xl text-amber-500"></i>
                    </div>
                </div>
            </div>
            {{-- tabel --}}
            <div class="container mx-auto p-4">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white bg-indigo-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">Full Name</th>
                                <th scope="col" class="px-6 py-3">Email Address</th>

                                <th scope="col" class="px-6 py-3">Progress</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enrolledUsers as $user)
                                <tr class="bg-white border-t hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="bg-purple-600 text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $user->email }}</td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->progress_percentage >= 75
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($user->progress_percentage >= 50
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-red-100 text-red-800') }}">
                                            {{ $user->progress_percentage }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        @if (($user->progress_percentage ?? 0) >= 100)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Finished
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Ongoing
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button id="show" onclick="showUser({{ $user->id }})"
                                                class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                                aria-label="show">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            {{-- Tombol Delete dengan form yang sudah diperbarui --}}

                                            <button type="button"
                                                class="delete-btn w-8 h-8 rounded-sm bg-red-400 hover:bg-red-500 text-white flex items-center justify-center"
                                                aria-label="delete" data-form-id="delete-form-{{ $user->id }}"
                                                data-title="{{ $course->title }}" data-username="{{ $user->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <!-- Form tersembunyi untuk submit -->
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('myparticipant.destroy', ['course' => $course->slug, 'user' => $user->id]) }}"
                                                method="POST" style="display: none;"
                                                data-title="{{ $course->title }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada peserta terdaftar di kursus ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- modal start --}}
            @foreach ($enrolledUsers as $user)
                <div class="">
                    <div id="modal"
                        class="modal ml-54 hidden opacity-0 fixed inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">

                        {{-- Konten Modal --}}
                        <div
                            class="min-w-full bg-slate-100 rounded-lg pl-15 p-3  max-h-[90vh] flex flex-col gap-4 overflow-y-auto">
                            <div class="flex justify-end relative">
                                <button id="closeModal" class="text-red-500 hover:text-red-700 focus:outline-none">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex gap-2">
                                <div class=" w-2/3">
                                    <div class="mb-2">
                                        <div for="full-name" class="block text-gray-700 text-sm font-bold mb-2">Full
                                            Name</div>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="email"
                                            class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="handphone"
                                            class="block text-gray-700 text-sm font-bold mb-2">Handphone</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->no_telp ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="role"
                                            class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->role }}
                                        </div>
                                    </div>
                                </div>
                                <div class="  w-1/3 flex justify-center items-start">
                                    <div class="relative ">
                                        <div
                                            class="rounded-full size-62 bg-gray-300 flex items-center justify-center overflow-hidden">
                                            {{-- Placeholder untuk foto profil --}}
                                            @if ($user->image)
                                                <img src=" {{ asset('storage/' . $user->image) }}" alt=""
                                                    class="w-full object-cover rounded-full size-62 bg-gray-300 flex items-center justify-center">
                                            @else
                                                <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://picsum.photos/900/600?random=' . $user->id }}"
                                                    alt=""
                                                    class="w-full object-cover rounded-full size-62 bg-gray-300 flex items-center justify-center">
                                            @endif

                                        </div>
                                        <button
                                            class="absolute bottom-0 right-0 bg-gray-200 rounded-full p-1 hover:bg-gray-300 focus:outline-none focus:shadow-outline">
                                            <svg class="size-10 text-gray-700" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0010.07 4h3.86a2 2 0 001.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h2 class="block text-gray-700 text-sm font-bold mb-2">Courses Enrolled</h2>
                                <div
                                    class="bg-indigo-100  p-2 rounded-lg border-2 border-indigo-300 overflow-y-auto h-50 course-created-scrollable">
                                    @if ($user->enrolled_courses->count() > 0)
                                        <ul class="space-y-2">
                                            @foreach ($user->enrolled_courses->sortBy('title') as $enrolledCourse)
                                                <li
                                                    class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                                    <div class="flex items-center max-w-200 overflow-hidden">
                                                        <div
                                                            class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0">
                                                        </div>
                                                        <span class="truncate min-w-0"
                                                            title="{{ $enrolledCourse->title }}">
                                                            {{ $enrolledCourse->title }}
                                                        </span>
                                                    </div>
                                                    <span class="text-sm text-gray-600">Course</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="text-center text-gray-500 py-4">
                                            <p>No courses enrolled yet</p>
                                            <p class="text-xs">User ID: {{ $user->id }} - Courses relation loaded:
                                                {{ $user->relationLoaded('courses') ? 'Yes' : 'No' }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                        Apakah Anda yakin ingin menghapus <span id="user-name-to-delete"
                                            class="text-gray-900 font-semibold"> </span> dari

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
    const modalOpen = document.querySelectorAll('#show');
    const modal = document.querySelectorAll('#modal');
    const modalClose = document.querySelectorAll('#closeModal');

    for (let i = 0; i < modalOpen.length; i++) {
        modalOpen[i].addEventListener('click', () => {
            modal[i].classList.remove('hidden');
            setTimeout(() => {
                modal[i].classList.remove('opacity-0')
            }, 10);


        });
        modalClose[i].addEventListener('click', () => {
            modal[i].classList.add('opacity-0');
            setTimeout(() => {
                modal[i].classList.add('hidden')
            }, 500);
        })
    }


    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('delete-confirmation-modal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const contentTitleElement = document.getElementById('content-title-to-delete');
        const userNameElement = document.getElementById('user-name-to-delete');

        let formToSubmit = null;

        // Fungsi untuk menampilkan modal dengan transisi
        const showModal = (form, title, username = 'user ini') => {
            formToSubmit = form;
            contentTitleElement.textContent = `'${title}'`;
            if (userNameElement) {
                userNameElement.textContent = username;
            }
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
                const formId = this.dataset.formId;
                const form = document.getElementById(formId);
                const title = this.dataset.title ?? 'Course';
                const username = this.dataset.username ?? 'User';

                showModal(form, title, username);
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
