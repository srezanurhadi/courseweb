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
        <div class=" w-full bg-gray-50 ">
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-99">
                <div class="text-3xl font-bold pl-4">Management Content</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>
            <div class="w-full flex pt-8 px-4 justify-between">
                <div class="flex gap-4">
                    <form action="{{ Request::is('admin/mycontent') ? '/admin/mycontent' : '/admin/content' }}" method="GET" class="flex gap-4" id="search-form">
                        <div class="flex gap-2">
                            {{-- Input Pencarian --}}
                            <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                                <i class="fas fa-search text-gray-500"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic bg-transparent"
                                    placeholder="Search Content...">
                            </div>

                            <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                                <i class="fas fa-filter text-gray-500"></i> {{-- Mengganti ikon agar lebih sesuai --}}
                                <select name="category" id="category"
                                    class="min-w-56 focus:outline-none px-2 text-gray-900 bg-transparent"
                                    onchange="this.form.submit()"> {{-- [OPSIONAL] Otomatis submit saat kategori diubah --}}
                                    <option value="">All Roles</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category }}"
                                            {{ request('category') == $category->category ? 'selected' : '' }}>
                                            {{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tombol Search --}}
                            <button type="submit" class="bg-sky-600 px-4 rounded-lg">
                                <p class="font-medium text-base text-white">Search</p>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="">
                    <a href="" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
                            class="fas fa-plus text-gray-50"></i> Add Content</a>
                </div>

            </div>
            <div class="p-4 flex justify-around gap-2  ">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold">
                        <div class="text-base text-gray-800">All Content</div>
                        <div class="text-3xl text-indigo-700 pl-4">{{ $allcontents->count()}}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                        <i class="fas fa-book text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col  font-semibold ">
                        <div class="text-base text-gray-800">Categories</div>
                        <div class="text-3xl text-green-700 pl-4">{{ $categories->count() }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-tag text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Used</div>
                        <div class="text-3xl text-amber-500 pl-4">{{ $usedContentCount }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-check text-2xl text-amber-500"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-rose-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Unused</div>
                        <div class="text-3xl text-rose-500 pl-4">{{ $unusedContentCount }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-rose-200 h-10 w-10 m-4">
                        <i class="fas fa-x text-2xl text-rose-500"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 relative">
                <div class="bg-gray-50 shadow-lg rounded-xl overflow-hidden pb-5">
                    {{-- header --}}
                    <div class="flex bg-indigo-600 text-gray-50 text-xs font-semibold uppercase tracking-wider">
                        <div class="px-6 py-3 w-4/12 text-left">Judul Konten</div>
                        <div class="px-6 py-3 w-2/12 text-left">Author</div>
                        <div class="px-6 py-3 w-2/12 text-left">Category</div>
                        <div class="px-6 py-3 w-2/12 text-left">Created At</div>
                        <div class="px-6 py-3 w-2/12 text-left">Action</div>
                    </div>
                    {{-- data --}}
                    <div class="space-y-4 px-4 py-4">
                        @foreach ($contents as $content)
                            <div class="flex items-center bg-amber-100 rounded-lg shadow-md text-sm font-medium">
                                <div class="px-6 py-3 w-4/12 text-gray-900">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-md bg-amber-500 flex items-center justify-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L1.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-.813 2.846a4.5 4.5 0 00-3.09 3.09zM18.25 12L17 14.25l-1.25-2.25L13.5 11l2.25-1.25L17 7.5l1.25 2.25L20.5 11l-2.25 1.25z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 truncate">
                                            {{ $content->title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">
                                    {{ optional($content->creator)->name ?? 'Tidak diketahui' }}</div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">{{ $content->category->category }}
                                </div>
                                <div class="px-6 py-3 w-2/12 text-gray-700">{{ $content->created_at->format('d-m-Y') }}
                                </div>
                                <div class="px-6 py-3 w-2/12">
                                    <div class="flex items-center space-x-2">
                                        <a href="content/{{ $content->slug }}"
                                            class="w-8 h-8 rounded-sm bg-sky-500 hover:bg-sky-600 text-white flex items-center justify-center"
                                            aria-label="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="content/{{ $content->slug }}/edit"
                                            class="w-8 h-8 rounded-sm bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center"
                                            aria-label="Ubah">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="content/{{ $content->slug }}" method="post" class="w-8 h-8">
                                            @method('delete')
                                            @csrf
                                            <button type="button"
                                                class="delete-btn w-8 h-8 rounded-sm bg-red-500 hover:bg-red-600 text-white flex items-center justify-center cursor-pointer"
                                                data-title="{{ $content->title }}" aria-label="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="mt-4 mb-10">
                {{ $contents->appends(request()->all())->links() }}
            </div>
            <div id="delete-confirmation-modal"
                class="fixed inset-0 z-[100] flex items-center justify-center bg-white/10 backdrop-blur-sm bg-opacity-50 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
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
</body>
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
