<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>

    <style>
        /* From Uiverse.io by alexruix */
        .loader {
            width: 48px;
            height: 48px;
            margin: auto;
            position: relative;
        }

        .loader:before {
            content: '';
            width: 48px;
            height: 5px;
            background: #f0808050;
            position: absolute;
            top: 60px;
            left: 0;
            border-radius: 50%;
            animation: shadow324 0.5s linear infinite;
        }

        .loader:after {
            content: '';
            width: 100%;
            height: 100%;
            background: #f08080;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 4px;
            animation: jump7456 0.5s linear infinite;
        }

        @keyframes jump7456 {
            15% {
                border-bottom-right-radius: 3px;
            }

            25% {
                transform: translateY(9px) rotate(22.5deg);
            }

            50% {
                transform: translateY(18px) scale(1, .9) rotate(45deg);
                border-bottom-right-radius: 40px;
            }

            75% {
                transform: translateY(9px) rotate(67.5deg);
            }

            100% {
                transform: translateY(0) rotate(90deg);
            }
        }

        @keyframes shadow324 {

            0%,
            100% {
                transform: scale(1, 1);
            }

            50% {
                transform: scale(1.2, 1);
            }
        }
    </style>
</head>

<body>
    <div class="flex flex-1 relative">
        <x-sidebar></x-sidebar>
        <div class="flex-1 bg-gray-50 flex flex-col p-4">
            <form action="/{{ Auth::user()->role }}{{ Request::is('*/mycourse*') ? '/mycourse' : '/course' }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div
                    class="bg-gray-100 h-full p-4 pl-6 rounded-lg shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-2">
                    <h1 class="font-bold text-3xl pt-2">Create New Course</h1>

                    {{-- title --}}
                    <div class="mb-4">
                        <label for="title" class="text-sm">Course Title<span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="@error('title') is-invalid @enderror w-full
                                px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:border-indigo-500"
                            placeholder="Course Title..." required>
                        @error('title')
                            <div class="invalid-feedback text-red-600 italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- image --}}
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar
                            Galeri <span class="text-red-500">*</span></label>
                        <div
                            class="mt-1 w-100 aspect-4/3 flex justify-center items-center px-6 pt-5 pb-6 border-2 bg-gray-50 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <p class="pl-1 mr-2">drag and drop or</p>
                                    <label for="image"
                                        class="pl-2relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>click to upload</span>
                                        <input id="image" name="image" type="file" class="sr-only"
                                            accept="image/*" required>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF hingga 2MB
                                </p>
                            </div>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview Image:</p>
                            <img id="preview-img"
                                class="w-100 aspect-4/3 object-cover object-center border-2 border-gray-400 rounded-md"
                                alt="Image preview" />
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="mb-4">
                        <label for="description" class="text-sm">Course Description<span
                                class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2" placeholder="Description of the course..."
                            required>{{ old('description') }}
                        </textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg flex flex-col justify-center items-center p-4">
                            <div class="flex flex-row justify-between w-full mb-4">
                                <label for="course-content" class="text-sm">Course Content<span
                                        class="text-red-500">*</span></label>
                                <button id="add_content"
                                    class="text-sm rounded-lg bg-indigo-700 text-gray-50 p-2 hover:bg-indigo-600 transition-all duration-300 cursor-pointer">+
                                    add content</button>
                            </div>
                            <div id="no-content-message" class="text-sm text-gray-700 p-4">No content add yet. click
                                "Add Content" to Add
                                course materials</div>
                            <div id="selected-content-container" class="space-y-4 w-full">
                                <!-- Selected content will be displayed here -->
                            </div>
                            <input type="hidden" name="selected_content_ids" id="selected_content_ids" value="">

                        </div>
                        @error('selected_content_ids')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category" class="text-sm">Course Category<span class="text-red-500">*</span></label>
                        <select name="category" id="category"
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2 text-sm text-gray-700">
                            @foreach ($categories as $category)
                                <option value="" hidden selected>Select Category</option>
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="status" value="0">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="status" value="1" checked
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-4 w-4">
                            <span class="ml-2 text-sm text-gray-700">Publish Now</span>
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Check to publish, if not checked the course will be
                            saved as a draft.</p>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-row justify-end gap-4">
                            <div onclick="window.location.href='{{ url('/admin/course') }}'"
                                class="py-2 w-34 px-6 text-indigo-700 bg-gray-50 border-2 border-indigo-700 shadow-sm rounded-lg text-center hover:shadow-none hover:bg-gray-100 transition-all duration-300 cursor-pointer">
                                Cancel</div>
                            <button type="submit"
                                class="py-2 px-6 w-34 text-gray-50 bg-indigo-700 border-2 border-indigo-700  shadow-sm rounded-lg text-center hover:shadow-none hover:bg-indigo-800 transition-all duration-300 cursor-pointer">
                                Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div id="modal"
            class="modal ml-54 hidden opacity-0 fixed inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">
            <div class="p-4 w-full max-w-6xl bg-gray-100 rounded-lg ">
                <div id="ajax-solution">
                    <div class="w-full bg-gray-100 flex pt-2 pb-4 px-1 justify-between">
                        <div class="flex gap-4 justify-between">
                            <div class="flex gap-2">
                                <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                                    <i class="fas fa-search text-gray-500"></i>
                                    <input type="text" id="ajax-search"
                                        class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic"
                                        placeholder="Search Course...">
                                </div>
                                <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                                    <i class="fas fa-filter text-gray-500"></i>
                                    <select id="ajax-category-filter"
                                        class="min-w-56 focus:outline-none px-2 text-gray-900">
                                        <option value="">All Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button id="ajax-search-btn"
                                    class="bg-sky-600 px-2 rounded-lg hover:bg-sky-700 text-white transition-all duration-300 cursor-pointer ">
                                    <p class=" font-medium text-base text-white">search</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content List Container -->
                <div
                    class="bg-gray-50 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl overflow-hidden pb-5 relative">
                    {{-- header --}}
                    <div
                        class="relative flex bg-indigo-600 text-gray-50 text-xs font-semibold uppercase tracking-wider">
                        <div class="px-6 py-3 w-6/12 text-left">Judul Konten</div>
                        <div class="px-6 py-3 w-2/12 text-left">Category</div>
                        <div class="px-6 py-3 w-2/12 text-left">Created At</div>
                        <div class="px-6 py-3 w-2/12 text-left flex flex-col mr-6">Action</div>
                    </div>

                    {{-- Content List --}}
                    <div id="content-list" class="space-y-4 px-4 py-4 overflow-y-auto h-100">
                        @forelse ($contents as $content)
                            <div class="flex items-center rounded-lg shadow-md text-sm font-medium"
                                style="background-color: {{ $content->category->color }}20;">
                                <div class="px-6 py-3 w-6/12 text-gray-900">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-md bg-amber-500 flex items-center justify-center text-white"
                                            style="background-color: {{ $content->category->color }};">
                                            <i class="{{ $content->category->icon }}"></i>

                                        </div>
                                        <div class="ml-4 truncate">{{ $content->title }}</div>
                                    </div>
                                </div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">
                                    {{ $content->category->category }}</div>
                                <div class="px-6 py-3 w-2/12 text-gray-700">
                                    {{ $content->created_at->format('d-m-Y') }}</div>
                                <div class="px-6 py-3 w-2/12">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex justify-center w-full transition-all duration-300">
                                            <input type="checkbox" id="content_{{ $content->id }}"
                                                name="content_checkbox" value="{{ $content->id }}"
                                                data-title="{{ $content->title }}"
                                                class="h-6 w-6 border-gray-300 rounded focus:ring-indigo-700 text-indigo-700 cursor-pointer transition-all duration-300">
                                        </div>
                                        <a href="{{ url('admin/content/' . $content->slug) }}" target="_blank">
                                            <button
                                                class="lihat-btn w-6 h-6 p-2 rounded-sm bg-sky-500 hover:bg-sky-600 text-white flex items-center justify-center transition-all duration-300 cursor-pointer"
                                                aria-label="Lihat" data-content-id="{{ $content->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-600 py-4">Tidak ada konten yang ditemukan.</div>
                        @endforelse
                    </div>

                    <div id="loading-indicator"
                        class="absolute inset-0 bg-white/20 flex items-center justify-center z-50 hidden">
                        <div class="loader w-10 h-10">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex flex-row justify-end gap-4">
                            <button id="closeModal"
                                class="py-2 px-6 text-indigo-700 bg-gray-50 border-2 border-indigo-700 shadow-sm rounded-lg text-center hover:shadow-none hover:bg-gray-100 transition-all duration-300 cursor-pointer">Cancel</button>
                            <button id="saveSelectedContent" type="button"
                                class="py-2 px-6 text-gray-50 bg-indigo-700 border-2 border-indigo-700  shadow-sm rounded-lg text-center hover:shadow-none hover:bg-indigo-800 transition-all duration-300 cursor-pointer">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Gunakan nama yang benar dari hasil "php artisan route:list"
            const SEARCH_URL = '{{ route('course.search') }}';
        </script>

        <script>
            // AJAX Search Implementation
            const ajaxSearchInput = document.getElementById('ajax-search');
            const ajaxCategoryFilter = document.getElementById('ajax-category-filter');
            const ajaxSearchBtn = document.getElementById('ajax-search-btn');
            const contentList = document.getElementById('content-list');
            const loadingIndicator = document.getElementById('loading-indicator');
            let selectedContents = [];

            function performAjaxSearch() {
                const searchTerm = ajaxSearchInput.value;
                const categoryId = ajaxCategoryFilter.value;

                // Show loading
                loadingIndicator.classList.remove('hidden');
                contentList.style.opacity = '0.5';

                const params = new URLSearchParams();
                if (searchTerm) params.append('search', searchTerm);
                if (categoryId) params.append('category', categoryId);
                // params.append('ajax', '1'); // Ini tidak wajib jika Anda menggunakan header

                // URL endpoint yang kita buat di Laravel
                const url = `${SEARCH_URL}?${params.toString()}`;


                console.log('SEARCH_URL:', SEARCH_URL);
                console.log('Final URL:', url)

                fetch(url, {
                        method: 'GET',
                        headers: {
                            // Header ini penting agar Laravel tahu ini adalah request AJAX
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Panggil fungsi baru kita untuk update list
                        updateContentList(data.contents);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Sekarang kita tahu errornya adalah SyntaxError, kita bisa lebih yakin masalahnya di sini.
                        contentList.innerHTML =
                            `<div class="text-center text-red-600 py-4">Terjadi kesalahan saat memuat data (Format salah).</div>`;
                    })
                    .finally(() => {
                        // Selalu sembunyikan loading setelah selesai
                        hideLoading();
                    });
            }

            function hideLoading() {
                loadingIndicator.classList.add('hidden');
                contentList.style.opacity = '1';
            }

            function updateContentList(contents) {
                // Kosongkan daftar konten saat ini
                contentList.innerHTML = '';

                // Jika tidak ada konten yang ditemukan, tampilkan pesan
                if (!contents || contents.length === 0) {
                    contentList.innerHTML =
                        `<div class="text-center text-gray-600 py-4">Tidak ada konten yang ditemukan.</div>`;
                    return;
                }

                const currentlyChecked = [];
                document.querySelectorAll('input[name="content_checkbox"]:checked').forEach(checkbox => {
                    currentlyChecked.push({
                        id: parseInt(checkbox.value),
                        title: checkbox.getAttribute('data-title')
                    });
                });

                let html = '';
                contents.forEach(content => {
                    // **PENTING: Cek apakah konten ini sudah dipilih sebelumnya**
                    // Kita menggunakan array 'selectedContents' dari script Anda sebelumnya
                    const isChecked = selectedContents.some(item => item.id == content.id);

                    html += `
            <div class="flex items-center bg-amber-100 rounded-lg shadow-md text-sm font-medium">
                <div class="px-6 py-3 w-4/12 text-gray-900">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-8 w-8 rounded-md bg-amber-500 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L1.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-.813 2.846a4.5 4.5 0 00-3.09 3.09zM18.25 12L17 14.25l-1.25-2.25L13.5 11l2.25-1.25L17 7.5l1.25 2.25L20.5 11l-2.25 1.25z" />
                            </svg>
                        </div>
                        <div class="ml-4 truncate">${content.title}</div>
                    </div>
                </div>
                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">${content.category_name}</div>
                <div class="px-6 py-3 w-2/12 text-gray-700">${content.created_at}</div>
                <div class="px-6 py-3 w-2/12 text-gray-700">Belum pernah dipilih</div>
                <div class="px-6 py-3 w-2/12">
                    <div class="flex items-center space-x-2">
                        <div class="flex justify-center w-full">
                            <input type="checkbox" name="content_checkbox" value="${content.id}" data-title="${content.title}"
                                class="h-6 w-6 border-gray-300 rounded focus:ring-indigo-700 text-indigo-700"
                                ${isChecked ? 'checked' : ''}> 
                        </div>
                        <a href="/admin/content/${content.slug}" target="_blank">
                            <button class="lihat-btn w-6 h-6 p-2 rounded-sm bg-sky-500 hover:bg-sky-600 text-white flex items-center justify-center" aria-label="Lihat">
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        `;
                });

                // Masukkan semua HTML yang sudah digenerate ke dalam list
                contentList.innerHTML = html;
            }

            // Event listeners for AJAX search
            ajaxSearchBtn.addEventListener('click', performAjaxSearch);
            ajaxSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performAjaxSearch();
                }
            });
            ajaxCategoryFilter.addEventListener('change', performAjaxSearch);


            // Original modal functionality
            const modalOpen = document.querySelectorAll('#add_content');
            const modal = document.querySelectorAll('#modal');
            const modalClose = document.querySelectorAll('#closeModal');

            for (let i = 0; i < modalOpen.length; i++) {
                modalOpen[i].addEventListener('click', (e) => {
                    e.preventDefault();
                    modal[i].classList.remove('hidden');
                    setTimeout(() => {
                        modal[i].classList.remove('opacity-0');
                    }, 10);
                });

                modalClose[i].addEventListener('click', (e) => {
                    e.preventDefault();
                    modal[i].classList.add('opacity-0');
                    setTimeout(() => {
                        modal[i].classList.add('hidden');
                        // Remove hash from URL when closing modal
                        if (window.location.hash === '#modal') {
                            window.history.replaceState(null, null, window.location.pathname);
                        }
                    }, 500);
                });
            }

            // Image Preview Functionality
            const imageInput = document.getElementById('image');
            const imagePreviewDiv = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-img');

            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                imagePreviewDiv.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            previewImage.src = '#';
                            imagePreviewDiv.classList.add('hidden');
                            alert('Harap pilih file gambar (PNG, JPG, GIF).');
                        }
                    } else {
                        previewImage.src = '#';
                        imagePreviewDiv.classList.add('hidden');
                    }
                });
            }

            // Content Selection Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const saveSelectedContentBtn = document.getElementById('saveSelectedContent');
                const selectedContentContainer = document.getElementById('selected-content-container');
                const noContentMessage = document.getElementById('no-content-message');
                const selectedContentIdsInput = document.getElementById('selected_content_ids');

                if (saveSelectedContentBtn) {
                    saveSelectedContentBtn.addEventListener('click', function() {
                        const checkedBoxes = document.querySelectorAll(
                            'input[name="content_checkbox"]:checked');
                        selectedContents = [];

                        checkedBoxes.forEach(function(checkbox, index) {
                            const contentId = checkbox.value;
                            const contentTitle = checkbox.getAttribute('data-title');

                            selectedContents.push({
                                id: contentId,
                                title: contentTitle,
                                order: index + 1
                            });
                        });

                        selectedContentIdsInput.value = JSON.stringify(selectedContents);
                        updateSelectedContentDisplay();

                        // Close modal
                        const modalElement = document.querySelector('#modal');
                        if (modalElement) {
                            modalElement.classList.add('opacity-0');
                            setTimeout(() => {
                                modalElement.classList.add('hidden');
                                // Remove hash from URL
                                if (window.location.hash === '#modal') {
                                    window.history.replaceState(null, null, window.location.pathname);
                                }
                                const contentSection = document.getElementById(
                                    'selected-content-container').closest('.mb-4');
                                if (contentSection) {
                                    contentSection.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'center'
                                    });
                                }
                            }, 500);
                        }
                    });
                }

                function updateSelectedContentDisplay() {
                    selectedContentContainer.innerHTML = '';

                    if (selectedContents.length === 0) {
                        noContentMessage.classList.remove('hidden');
                        return;
                    }

                    noContentMessage.classList.add('hidden');

                    selectedContents.forEach(function(content, index) {
                        const contentCard = document.createElement('div');
                        contentCard.className =
                            'flex items-start p-4 border border-gray-300 rounded-md bg-white shadow-sm';
                        contentCard.dataset.contentId = content.id;

                        contentCard.innerHTML = `
                <div class="mr-3">
                    <div class="w-6 h-6 rounded-full bg-indigo-600 text-white text-xs flex items-center justify-center font-bold">
                        ${index + 1}
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">${content.title}</h3>
                    <p class="text-sm text-gray-600">Selected content item</p>
                </div>
                <div class="ml-3 flex flex-col items-center justify-center space-y-1">
                    <button type="button" class="move-up-btn text-gray-500 hover:text-gray-700" data-index="${index}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </button>
                    <button type="button" class="move-down-btn text-gray-500 hover:text-gray-700" data-index="${index}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <button type="button" class="remove-content-btn ml-3 text-red-500 hover:text-red-700" data-index="${index}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1h.54l.7 10.11A2 2 0 006.73 17h6.54a2 2 0 001.99-1.89L16.96 5H17.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 4a.5.5 0 011 0v7a.5.5 0 01-1 0V6zm4 0a.5.5 0 011 0v7a.5.5 0 01-1 0V6z" />
                    </svg>
                </button>
            `;

                        selectedContentContainer.appendChild(contentCard);
                    });

                    addContentCardEventListeners();
                }

                function addContentCardEventListeners() {
                    document.querySelectorAll('.remove-content-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const index = parseInt(this.dataset.index);

                            if (selectedContents[index]) {
                                const contentIdToRemove = selectedContents[index].id;

                                const checkboxToUncheck = document.querySelector(
                                    `input[name="content_checkbox"][value="${contentIdToRemove}"]`);
                                if (checkboxToUncheck) {
                                    checkboxToUncheck.checked = false;
                                }
                            }

                            selectedContents.splice(index, 1);
                            selectedContentIdsInput.value = JSON.stringify(selectedContents);
                            updateSelectedContentDisplay();
                            const correspondingCheckbox = document.querySelector(
                                `input[name="content_checkbox"][value="${removedItem.id}"]`);
                            if (correspondingCheckbox) {
                                correspondingCheckbox.checked = false;
                            }
                        });
                    });

                    document.querySelectorAll('.move-up-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const index = parseInt(this.dataset.index);
                            if (index > 0) {
                                [selectedContents[index], selectedContents[index - 1]] = [
                                    selectedContents[index - 1], selectedContents[index]
                                ];
                                updateSelectedContentDisplay();
                            }
                        });
                    });

                    document.querySelectorAll('.move-down-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const index = parseInt(this.dataset.index);
                            if (index < selectedContents.length - 1) {
                                [selectedContents[index], selectedContents[index + 1]] = [
                                    selectedContents[index + 1], selectedContents[index]
                                ];
                                updateSelectedContentDisplay();
                            }
                        });
                    });
                }
            });

            ;
        </script>

</html>
