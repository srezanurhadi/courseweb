import './bootstrap';

// 1. Impor semua yang dibutuhkan
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import ImageTool from '@editorjs/image';

// 2. Ambil elemen-elemen penting dari DOM
const contentForm = document.getElementById('contentForm');
const editorContentInput = document.getElementById('editor_content');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// 3. Inisialisasi EditorJS
const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        list: List,
        image: {
            class: ImageTool,
            config: {
                uploader: {
                    uploadByFile(file) {
                        let formData = new FormData();
                        formData.append('image', file);

                        // Endpoint untuk upload gambar
                        return fetch('/admin/upload-image', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).then(response => response.json()).then(result => {
                            // Kembalikan response ke editor
                            return result;
                        });
                    },
                }
            }
        }
    },
    placeholder: 'Mulai tulis di sini...',
});

// 4. ✨ PENTING: Tambahkan event listener untuk form submission
if (contentForm) {
    contentForm.addEventListener('submit', function (event) {
        // Hentikan pengiriman form sementara
        event.preventDefault();

        editor.save().then((outputData) => {
            // Cek jika editor tidak kosong
            if (outputData.blocks.length > 0) {
                // Masukkan data JSON ke input tersembunyi
                editorContentInput.value = JSON.stringify(outputData);
                // Lanjutkan pengiriman form
                contentForm.submit();
            } else {
                // Beri peringatan jika konten kosong
                alert('Konten tidak boleh kosong!');
            }
        }).catch((error) => {
            console.log('Gagal menyimpan data editor:', error);
            alert('Terjadi kesalahan saat menyimpan konten.');
        });
    });
}
