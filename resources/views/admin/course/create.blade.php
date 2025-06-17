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
    <div class="flex flex-1 relative">
        <x-sidebar></x-sidebar>
        <div class="flex-1 bg-gray-50 flex flex-col p-4">
            <form action="/admin/course" method="POST" enctype="multipart/form-data">
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
                            required>
                        @error('title')
                            <div class="invalid-feedback text-red-600 italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- image --}}
                    <div class="mb-4">
                        <label for="image" lass="block text-sm font-medium text-gray-700 mb-1">Upload Gambar
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
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2" placeholder="Description of the course...">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <div
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg flex flex-col justify-center items-center p-4">
                            <div class="flex flex-row justify-between w-full">
                                <label for="course-content" class="text-sm">Course Content<span
                                        class="text-red-500">*</span></label>
                                <button id="add_content" class="text-sm rounded-lg bg-indigo-700 text-gray-50 p-2">+
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
                                class="py-2 w-34 text-indigo-700 bg-gray-50 border-2 border-indigo-700 rounded-lg text-center">
                                Cancel</div>
                            <button type="submit"
                                class="py-2 w-34 text-gray-50 bg-indigo-700 border-2 border-indigo-700 rounded-lg text-center">
                                Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="modal"
            class="modal ml-54 hidden opacity-0 fixed inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">
            <div class="p-4 w-full max-w-6xl bg-gray-100 rounded-lg ">
                {{-- Search dll --}}
                <div class="w-full bg-gray-100 flex pt-2 pb-4 px-1 justify-between">
                    <div class="flex gap-4 justify-between">
                        <form action={{ url('/admin/course/create#modal') }} method="GET" class="flex gap-2">
                            <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                                <i class="fas fa-search text-gray-500"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic"
                                    placeholder="Search Course...">
                            </div>
                            <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                                <i class="fas fa-filter text-gray-500"></i>
                                <select name="category" id="category"
                                    class="min-w-56 focus:outline-none px-2 text-gray-900"
                                    onchange="this.form.submit()">

                                    <option value="" {{ request('category') ? '' : 'selected' }}>All Category
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category }}
                                        </option>
                                    @endforeach`
                                </select>
                            </div>
                            <button class="bg-sky-600 px-2 rounded-lg">
                                <p class=" font-medium text-base text-white">search</p>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl overflow-hidden pb-5">

                    {{-- header --}}
                    <div
                        class="relative flex bg-indigo-600 text-gray-50 text-xs font-semibold uppercase tracking-wider">
                        <div class="px-6 py-3 w-4/12 text-left">Judul Konten</div>
                        <div class="px-6 py-3 w-2/12 text-left">Category</div>
                        <div class="px-6 py-3 w-2/12 text-left">Created At</div>
                        <div class="px-6 py-3 w-2/12 text-left">Status</div>
                        <div class="px-6 py-3 w-2/12 text-left flex flex-col mr-6">
                            <div>Action</div>
                        </div>

                    </div>
                    {{-- data --}}
                    <div class="space-y-4 px-4 py-4 overflow-y-auto h-100">

                        @forelse ($contents as $content)
                            <div class="flex items-center bg-amber-100 rounded-lg shadow-md text-sm font-medium">

                                <div class="px-6 py-3 w-4/12 text-gray-900">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-md bg-amber-500 flex items-center justify-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
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
                                    {{ $content->category->category }}</div>
                                <div class="px-6 py-3 w-2/12 text-gray-700">
                                    {{ $content->created_at->format('d-m-Y') }}
                                </div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 ">Belum pernah dipilih</div>
                                <div class="px-6 py-3 w-2/12 ">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex justify-center w-full">
                                            <input type="checkbox" id="content_{{ $content->id }}"
                                                name="content_checkbox" value="{{ $content->id }}"
                                                data-title="{{ $content->title }}"
                                                class="h-6 w-6 border-gray-300 rounded focus:ring-indigo-700 text-indigo-700">
                                        </div>
                                        <button id="lihat"
                                            class="w-6 h-6 p-2 rounded-sm bg-sky-500 hover:bg-sky-600 text-white flex items-center justify-center"
                                            aria-label="Lihat" data-content-id="{{ $content->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-600 py-4">
                                Tidak ada konten yang ditemukan.
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex flex-row justify-end gap-4">
                        <button id="closeModal"
                            class="py-1 w-34 text-indigo-700 bg-gray-50 border-2 border-indigo-700 rounded-lg text-center">
                            Cancel</button>
                        <button id="saveSelectedContent" type="button"
                            class="py-1 w-34 text-gray-50 bg-indigo-700 border-2 border-indigo-700 rounded-lg text-center">
                            Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal2"
            class="modal2 ml-54 hidden opacity-0 fixed inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">
            <div class="p-4 w-full max-w-6xl relative">
                <button id="closeModal2" title="Close modal"
                    class="absolute top-0 right-0 transform -translate-y-1/2 text-gray-200 hover:text-white p-1 rounded-full bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="bg-gray shadow-lg rounded-xl overflow-hidden">
                    <div
                        class="w-full h-120 overflow-y-auto p-8 bg-gray-100 rounded-lg shadow-[0px_1px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-4">
                        <p class="text-2xl font-bold">
                            <!-- Content title will be loaded here -->
                        </p>
                        <p class="text-base font-medium indent-10">
                            <!-- Content body will be loaded here -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    const modalOpen = document.querySelectorAll('#add_content');
    const modal = document.querySelectorAll('#modal');
    const modalClose = document.querySelectorAll('#closeModal');

    for (let i = 0; i < modalOpen.length; i++) {
        modalOpen[i].addEventListener('click', (e) => {
            e.preventDefault();
            modal[i].classList.remove('hidden');
            setTimeout(() => {
                modal[i].classList.remove('opacity-0')
            }, 10);
        });

        modalClose[i].addEventListener('click', (e) => {
            e.preventDefault();
            modal[i].classList.add('opacity-0');
            setTimeout(() => {
                modal[i].classList.add('hidden')
            }, 500);
        });
    }

    // Modal 2 (Content Preview Modal) - FIXED VERSION
    document.addEventListener('DOMContentLoaded', function() {
        const modal2 = document.getElementById('modal2');
        const closeModal2Button = document.getElementById('closeModal2');

        // Function to close modal2
        function closeModal2() {
            if (modal2) {
                modal2.classList.add('opacity-0');
                setTimeout(() => {
                    modal2.classList.add('hidden');
                }, 500);
            }
        }

        // Function to open modal2 and load content
        function openModal2AndLoadContent(contentId) {
            const modalTitle = modal2.querySelector('.text-2xl.font-bold');
            const modalContent = modal2.querySelector('.text-base.font-medium.indent-10');

            // Clear previous content first
            modalTitle.textContent = '';
            modalContent.textContent = '';

            // Show loading state
            modalTitle.textContent = 'Loading...';
            modalContent.textContent = 'Loading content...';

            // Show the modal
            modal2.classList.remove('hidden');
            setTimeout(() => {
                modal2.classList.remove('opacity-0');
            }, 10);

            // Fetch content data
            fetch(`/admin/content/${contentId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Update modal with content data
                    modalTitle.textContent = data.title || 'No Title';
                    modalContent.textContent = data.content || 'No Content Available';
                })
                .catch(error => {
                    console.error('Error fetching content:', error);
                    modalTitle.textContent = 'Error Loading Content';
                    modalContent.textContent = 'Failed to load content. Please try again later.';
                });
        }

        // Event delegation for "lihat" buttons (handles dynamically loaded content)
        document.addEventListener('click', function(event) {
            if (event.target.closest('#lihat')) {
                event.preventDefault();
                const button = event.target.closest('#lihat');
                const contentId = button.getAttribute('data-content-id');

                if (contentId) {
                    openModal2AndLoadContent(contentId);
                }
            }
        });

        // Close modal2 with close button
        if (closeModal2Button) {
            closeModal2Button.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal2();
            });
        }

        // Close modal2 by clicking outside
        if (modal2) {
            modal2.addEventListener('click', function(event) {
                if (event.target === modal2) {
                    closeModal2();
                }
            });
        }

        // Close modal2 with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal2.classList.contains('hidden')) {
                closeModal2();
            }
        });
    });

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

        let selectedContents = [];

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
                    selectedContents.splice(index, 1);
                    selectedContentIdsInput.value = JSON.stringify(selectedContents);
                    updateSelectedContentDisplay();
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
</script>

</html>
