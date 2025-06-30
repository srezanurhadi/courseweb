<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile - R. DOSEN</title>
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
                                <a href="{{ route('user.profile.edit') }}" class="hover:text-indigo-900">Edit
                                    Profile</a>
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
                <!-- Edit Profile Section -->
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl">
                        <!-- Title -->
                        <div class="mb-2">
                            <h2 class="text-xl font-bold text-gray-800">Edit Profile</h2>
                        </div>

                        <section class="mb-8 rounded-md border border-gray-300 shadow-md bg-white">
                            <!-- Profile content -->
                            <div class="p-4 lg:p-6 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                <!-- Profile Form -->
                                <div class="flex-1 w-full">
                                    <form method="POST" action="{{ route('user.profile.update') }}"
                                        enctype="multipart/form-data" class="grid grid-cols-1 gap-4 w-full max-w-2xl">
                                        @csrf
                                        <!-- Include image input inside the form -->
                                        <input type="file" id="image" name="image" class="hidden"
                                            accept="image/*">
                                        <input type="hidden" id="delete-photo" name="delete_photo" value="0">

                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="fullname">Full
                                                Name</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full"
                                                id="fullname" name="name" type="text"
                                                value="{{ $user->name }}" />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="email">Email</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full bg-gray-100"
                                                id="email" name="email" type="email" value="{{ $user->email }}"
                                                readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="password">Password</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full"
                                                id="password" name="password" type="password"
                                                placeholder="Kosongkan jika tidak ingin diubah" />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="handphone">Handphone</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full"
                                                id="handphone" name="no_telp" type="text"
                                                value="{{ $user->no_telp }}" />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="role">Role</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full bg-gray-100"
                                                id="role" type="text" value="Participant" readonly />
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex flex-col">
                                                <label class="text-sm font-semibold mb-1 select-none"
                                                    for="joindate">Join Date</label>
                                                <input
                                                    class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full bg-gray-100"
                                                    id="joindate" type="text"
                                                    value="{{ $user->created_at->format('Y') }}" readonly />
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="text-sm font-semibold mb-1 select-none" for="enddate">End
                                                    Date</label>
                                                <input
                                                    class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full bg-gray-100"
                                                    id="enddate" type="text" value="-" readonly />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button
                                                class="text-indigo-700 border border-indigo-700 rounded-md px-8 py-2 text-sm font-semibold hover:bg-indigo-700 hover:text-white transition-colors"
                                                type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Profile Photo Section - Now on the right side -->
                                <div class="flex flex-col items-center gap-4 lg:w-1/3 order-first lg:order-last">
                                    <div class="relative">
                                        <!-- Profile Photo Container -->
                                        <div id="image-container"
                                            class="w-32 h-32 sm:w-54 sm:h-54 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden cursor-pointer relative group"
                                            onclick="togglePhotoMenu()">
                                            @if ($user->image)
                                                {{-- Jika pengguna punya gambar, tampilkan gambar tersebut --}}
                                                <img id="image-preview" src="{{ asset('storage/' . $user->image) }}"
                                                    alt="{{ $user->name }}" class="w-full h-full object-cover">
                                                <span id="initials-preview"
                                                    class="text-3xl sm:text-4xl font-semibold text-indigo-700 hidden">
                                                    @php
                                                        $words = explode(' ', $user->name);
                                                        $initials = strtoupper(substr($words[0], 0, 1));
                                                        if (isset($words[1])) {
                                                            $initials .= strtoupper(substr($words[1], 0, 1));
                                                        }
                                                    @endphp
                                                    {{ $initials }}
                                                </span>
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

                                            <!-- Hover overlay -->
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                <i class="fas fa-camera text-white text-2xl"></i>
                                            </div>
                                        </div>

                                        <!-- Photo Menu Dropdown -->
                                        <div id="photo-menu"
                                            class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 py-2 min-w-[150px] z-20">
                                            <button onclick="selectPhoto()"
                                                class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                                                <i class="fas fa-camera text-indigo-600"></i>
                                                <span>Ubah Foto</span>
                                            </button>
                                            @if ($user->image)
                                                <button onclick="deletePhoto()"
                                                    class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                                    <i class="fas fa-trash text-red-600"></i>
                                                    <span>Hapus Foto</span>
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Camera icon (keep for backup/alternative access) -->
                                        <label for="image"
                                            class="cursor-pointer absolute bottom-0 right-0 bg-white rounded-full p-3 shadow-md hover:bg-gray-100">
                                            <i class="fas fa-camera text-indigo-700 text-md"></i>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-500">Participant</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const initialsPreview = document.getElementById('initials-preview');
            const photoMenu = document.getElementById('photo-menu');
            const deletePhotoInput = document.getElementById('delete-photo');

            // Handle file input change
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Tampilkan preview gambar
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');

                        // Sembunyikan inisial
                        initialsPreview.classList.add('hidden');

                        // Reset delete flag
                        deletePhotoInput.value = '0';

                        // Update menu (tambahkan opsi hapus jika belum ada)
                        updatePhotoMenu(true);
                    }

                    reader.readAsDataURL(file);
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('#image-container') && !event.target.closest('#photo-menu')) {
                    photoMenu.classList.add('hidden');
                }
            });
        });

        function togglePhotoMenu() {
            const photoMenu = document.getElementById('photo-menu');
            photoMenu.classList.toggle('hidden');
        }

        function selectPhoto() {
            const imageInput = document.getElementById('image');
            imageInput.click();
            document.getElementById('photo-menu').classList.add('hidden');
        }

        function deletePhoto() {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                const imagePreview = document.getElementById('image-preview');
                const initialsPreview = document.getElementById('initials-preview');
                const deletePhotoInput = document.getElementById('delete-photo');
                const imageInput = document.getElementById('image');

                // Hide image preview
                imagePreview.classList.add('hidden');
                imagePreview.src = '#';

                // Show initials
                initialsPreview.classList.remove('hidden');

                // Set delete flag
                deletePhotoInput.value = '1';

                // Clear file input
                imageInput.value = '';

                // Update menu (hilangkan opsi hapus)
                updatePhotoMenu(false);

                // Hide menu
                document.getElementById('photo-menu').classList.add('hidden');
            }
        }

        function updatePhotoMenu(hasPhoto) {
            const photoMenu = document.getElementById('photo-menu');
            const deleteButton = photoMenu.querySelector('button[onclick="deletePhoto()"]');

            if (hasPhoto && !deleteButton) {
                // Tambahkan tombol hapus jika belum ada
                const deleteBtn = document.createElement('button');
                deleteBtn.onclick = deletePhoto;
                deleteBtn.className =
                    'w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 flex items-center gap-2';
                deleteBtn.innerHTML = '<i class="fas fa-trash text-red-600"></i><span>Hapus Foto</span>';
                photoMenu.appendChild(deleteBtn);
            } else if (!hasPhoto && deleteButton) {
                // Hapus tombol hapus jika tidak ada foto
                deleteButton.remove();
            }
        }
    </script>
</body>

</html>
