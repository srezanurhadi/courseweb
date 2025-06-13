<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <x-headcomponent></x-headcomponent>
    {{-- Menambahkan style untuk menyembunyikan elemen --}}
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="flex flex-1 ">
        <x-sidebar></x-sidebar>
        <div class="w-full bg-gray-50 flex flex-col px-8 py-4">
            {{-- PERHATIKAN: Pastikan action form Anda benar. Jika Anda mengedit user dengan ID tertentu,
                 biasanya route-nya akan seperti /admin/users/{user_id} dengan method PUT/PATCH.
                 Namun, kita bisa menggunakan POST dengan method spoofing di Laravel.
                 Untuk saat ini, kita biarkan sesuai kode Anda. --}}
            <form action="/admin/users/{{ $name->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Method Spoofing untuk update --}}

                <div
                    class="bg-gray-100 h-full p-4 pl-6 rounded-lg shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-2">
                    <h1 class="font-bold text-3xl pt-2 text-center">Edit User</h1>

                    <div class="mb-2 mx-auto">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                            Upload Profile Picture <span class="text-red-500">*</span>
                        </label>

                        {{-- Area Pratinjau Gambar --}}
                        <div id="image-preview"
                            class="mt-1 aspect-6/4 h-48 flex justify-center items-center border-2 bg-gray-50 border-gray-300 relative">
                            {{-- PERBAIKAN: Menampilkan gambar yang ada dari storage.
                                 Asumsinya gambar disimpan di 'storage/nama_file.jpg' dan Anda sudah menjalankan `php artisan storage:link` --}}
                            <img id="preview-img" src="{{ $name->image ? asset('storage/' . $name->image) : '#' }}"
                                class="aspect-6/4 h-48 object-cover object-center border-2 border-gray-400 rounded-md"
                                alt="Image preview" />

                            {{-- Tombol untuk mengganti gambar --}}
                            <button type="button" id="change-image-button"
                                class="absolute bg-white/50 hover:bg-white rounded-full p-1 shadow-md text-gray-600 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.389-8.389-2.828-2.828z" />
                                </svg>
                            </button>
                        </div>

                        {{-- Area Unggah (Drag and Drop) --}}
                        <div id="upload"
                            class="mt-1 aspect-6/4 h-48 flex justify-center items-center px-6 pt-5 pb-6 border-2 bg-gray-50 border-gray-300 border-dashed rounded-md">
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
                                        class="pl-2 relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>click to upload</span>
                                        <input id="image" name="image" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG hingga 2MB
                                </p>
                            </div>
                        </div>

                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input fields lainnya (sudah benar) --}}
                    <div class="mb-2 font-semibold">
                        <label for="name" class="text-sm">Full Name<span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Full Name ..."
                            value="{{ old('name', $name->name) }}"
                            class="w-full px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none text-gray-700 focus:border-indigo-500"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2 font-semibold">
                        <label for="email" class="text-sm">Email<span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Email Address..."
                            value="{{ old('email', $name->email) }}"
                            class="w-full p-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none text-gray-700 focus:border-indigo-500"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2 font-semibold">
                        <label for="role" class="text-sm font-medium text-gray-700 block mb-1">Role<span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="role" id="role"
                                class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2 text-sm text-gray-500 focus:outline-none focus:border-indigo-500 appearance-none pr-8"
                                required aria-required="true">
                                <option value="" hidden selected>Select Role</option>
                                <option value="admin" {{ old('role', $name->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="author" {{ old('role', $name->role) == 'author' ? 'selected' : '' }}>
                                    Author</option>
                                <option value="user" {{ old('role', $name->role) == 'user' ? 'selected' : '' }}>User
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                <i class="fas fa-chevron-down fa-xs"></i>
                            </div>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2 font-semibold">
                        <label for="no_telp" class="text-sm">Phone Number</label>
                        <input type="number" name="no_telp" id="no_telp" placeholder="Optional"
                            value="{{ old('no_telp', $name->no_telp) }}"
                            class="w-full px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none text-gray-700 focus:border-indigo-500 text-sm">
                        @error('no_telp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <div class="flex flex-row justify-end gap-4">
                            <a href="javascript:history.back()"
                                class="py-2 px-4 text-indigo-700 bg-gray-50 border-2 border-indigo-700 rounded-lg text-center">Cancel</a>
                            <button type="submit"
                                class="py-2 px-4 text-gray-50 bg-indigo-700 border-2 border-indigo-700 rounded-lg text-center">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreviewDiv = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-img');
        const uploadDiv = document.getElementById('upload');
        const changeImageButton = document.getElementById('change-image-button');

        // PERBAIKAN: Fungsi untuk mengatur tampilan awal berdasarkan apakah gambar ada atau tidak
        function setInitialViewState() {
            // Cek apakah di tag <img> sudah ada src yang valid (bukan placeholder '#')
            if (previewImage.src && !previewImage.src.endsWith('#')) {
                // Jika ada gambar, tampilkan pratinjau dan sembunyikan area upload
                imagePreviewDiv.classList.remove('hidden');
                uploadDiv.classList.add('hidden');
            } else {
                // Jika tidak ada gambar, sembunyikan pratinjau dan tampilkan area upload
                imagePreviewDiv.classList.add('hidden');
                uploadDiv.classList.remove('hidden');
            }
        }

        // Event listener untuk input file
        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                // Pastikan file adalah gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        // Tampilkan pratinjau dan sembunyikan area upload setelah file dipilih
                        imagePreviewDiv.classList.remove('hidden');
                        uploadDiv.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert('Harap pilih file gambar (PNG, JPG, dll).');
                    // Jika file tidak valid, kembalikan ke kondisi awal
                    setInitialViewState();
                }
            }
        });

        // Event listener untuk tombol "Ganti Gambar"
        changeImageButton.addEventListener('click', function() {
            imageInput.click(); // Memicu klik pada input file tersembunyi
        });

        // Panggil fungsi untuk mengatur tampilan awal saat halaman selesai dimuat
        setInitialViewState();
    });
</script>

</html>
