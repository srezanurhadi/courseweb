<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Editor & Downloader</title>

    {{-- Memuat Tailwind CSS & FontAwesome (jika diperlukan) --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    {{-- Memuat Library Cropper.js dari CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

    <style>
        /* Menghilangkan panah di input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-2xl">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Image Editor</h1>
            <p class="text-gray-500">Upload, edit, dan unduh gambar Anda secara langsung.</p>
        </div>

        <div id="upload-area">
            <label for="image-input"
                class="flex justify-center w-full h-48 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                <span class="flex items-center space-x-2">
                    <i class="fas fa-cloud-upload-alt fa-2x text-gray-400"></i>
                    <span class="font-medium text-gray-600">
                        Klik untuk memilih gambar
                        <span class="text-blue-600 underline">atau seret ke sini</span>
                    </span>
                </span>
                <input type="file" id="image-input" name="file_upload" class="hidden" accept="image/*">
            </label>
        </div>

        <div id="editor-wrapper" class="hidden mt-6">
            <div class="bg-gray-200 p-2 rounded-lg">
                <img id="image-to-crop" class="max-w-full">
            </div>

            <div class="flex items-center justify-center space-x-4 mt-6">
                <button id="rotate-btn" title="Putar 90°"
                    class="flex items-center justify-center w-12 h-12 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition-all duration-200">
                    <i class="fas fa-undo fa-lg"></i>
                </button>
                <button id="download-btn"
                    class="flex items-center space-x-3 bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-download"></i>
                    <span>Unduh Gambar</span>
                </button>
                <button id="reset-btn" title="Pilih Gambar Lain"
                    class="flex items-center justify-center w-12 h-12 bg-red-200 text-red-700 rounded-full hover:bg-red-300 transition-all duration-200">
                    <i class="fas fa-times fa-lg"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT UTAMA --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const imageInput = document.getElementById('image-input');
            const imageToCrop = document.getElementById('image-to-crop');
            const editorWrapper = document.getElementById('editor-wrapper');
            const uploadArea = document.getElementById('upload-area');
            const rotateBtn = document.getElementById('rotate-btn');
            const downloadBtn = document.getElementById('download-btn');
            const resetBtn = document.getElementById('reset-btn');

            let cropper = null;

            // 1. Saat pengguna memilih sebuah file
            imageInput.addEventListener('change', (e) => {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        imageToCrop.src = reader.result;

                        // Tampilkan editor dan sembunyikan area upload
                        uploadArea.classList.add('hidden');
                        editorWrapper.classList.remove('hidden');

                        // Hancurkan instance cropper lama jika ada
                        if (cropper) {
                            cropper.destroy();
                        }

                        // 2. Inisialisasi Cropper.js
                        cropper = new Cropper(imageToCrop, {
                            aspectRatio: 16 / 9, // Rasio potong (contoh: widescreen)
                            viewMode: 1,
                            dragMode: 'move',
                            background: false, // Latar belakang transparan
                        });
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            // 3. Logika Tombol Putar
            rotateBtn.addEventListener('click', () => {
                if (cropper) {
                    cropper.rotate(-90); // Putar ke kiri
                }
            });

            // 4. Logika Tombol Reset/Batal
            resetBtn.addEventListener('click', () => {
                if (cropper) {
                    cropper.destroy();
                }
                imageToCrop.src = '';
                editorWrapper.classList.add('hidden');
                uploadArea.classList.remove('hidden');
                imageInput.value = ''; // Reset input file
            });

            // 5. Logika Tombol UNDUH (Inti dari permintaan Anda)
            downloadBtn.addEventListener('click', () => {
                if (!cropper) {
                    return;
                }

                // Mendapatkan hasil gambar yang sudah dipotong sebagai 'canvas'
                const canvas = cropper.getCroppedCanvas({
                    width: 1920, // Tentukan resolusi output
                    height: 1080,
                    imageSmoothingQuality: 'high',
                });

                // Mengubah canvas menjadi Blob (format file)
                canvas.toBlob((blob) => {
                    // Membuat URL sementara untuk file Blob di browser
                    const url = URL.createObjectURL(blob);

                    // Membuat elemen link <a> "tak kasat mata"
                    const a = document.createElement('a');

                    // Mengatur properti link
                    a.href = url;
                    a.download = `gambar-diedit-${Date.now()}.jpg`; // Nama file yang akan diunduh

                    // "Mengeklik" link tersebut secara otomatis untuk memicu unduhan
                    document.body.appendChild(a);
                    a.click();

                    // Membersihkan elemen setelah selesai
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);

                }, 'image/jpeg', 0.9); // Tipe file dan kualitas gambar
            });
        });
    </script>

</body>

</html>
