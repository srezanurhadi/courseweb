

// 1. Impor semua yang dibutuhkan
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import ImageTool from '@editorjs/image';

import Paragraph from 'editorjs-paragraph-with-alignment'; 
import Delimiter from '@editorjs/delimiter';
import Quote from '@editorjs/quote';
import CodeTool from '@editorjs/code';
import Table from '@editorjs/table';


// 2. Ambil elemen-elemen penting dari DOM
const contentForm = document.getElementById('contentForm');
const editorContentInput = document.getElementById('editor_content');
const editorHolder = document.getElementById('editorjs');
const userRole = editorHolder.dataset.role;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Inisialisasi initialEditorData di luar DOMContentLoaded jika ingin diakses di scope yang lebih luas
let initialEditorData = null;

// Tambahkan event listener untuk memastikan DOM sudah dimuat
document.addEventListener('DOMContentLoaded', () => { 

    
    const initialEditorDataElement = document.getElementById('initial-editor-data');
    if (initialEditorDataElement && initialEditorDataElement.textContent) {
        try {
            initialEditorData = JSON.parse(initialEditorDataElement.textContent);
            console.log("Initial Editor.js data parsed successfully:", initialEditorData); 
        } catch (e) {
            console.error("Error parsing initial Editor.js data:", e);
        }
    } else {
        console.warn("Element 'initial-editor-data' not found or empty. Editor.js will start with empty content."); 
    }

    // 3. Inisialisasi EditorJS
    const editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            header: { 
                class: Header,
                inlineToolbar: true, 
            },
            list: { 
                class: List,
                inlineToolbar: true,
            },
            image: {
                class: ImageTool,
                config: {
                    uploader: {
                        uploadByFile(file) {
                            let formData = new FormData();
                            formData.append('image', file);
                            const uploadUrl = `/${userRole}/upload-image`;
                            return fetch(uploadUrl, { 
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    }
                                }).then(response => response.json())
                                .then(result => {
                                    return result;
                                })
                                .catch(error => {
                                    console.error('Error uploading image:', error);
                                    alert('Failed to upload image.');
                                    return {
                                        success: 0
                                    }; 
                                });
                        },
                    },
                    withCaption: true,
                }
            },
            // Tambahkan konfigurasi untuk tools lain yang Anda gunakan
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            delimiter: Delimiter,
            quote: {
                class: Quote,
                inlineToolbar: true,
            },
            code: CodeTool,
            table: {
                class: Table,
                inlineToolbar: true,
            },
        },
        // ✨ PENTING: Berikan data awal ke Editor.js di sini
        data: initialEditorData || {}, // Gunakan initialEditorData jika ada, jika tidak, objek kosong
        placeholder: 'Mulai tulis di sini...',
    });

    // 4. Event listener untuk form submission
    if (contentForm) {
        contentForm.addEventListener('submit', function (event) {
            event.preventDefault();

            editor.save().then((outputData) => {
                if (outputData.blocks.length > 0) {
                    editorContentInput.value = JSON.stringify(outputData);
                    contentForm.submit();
                } else {
                    alert('Konten tidak boleh kosong!');
                }
            }).catch((error) => {
                console.log('Gagal menyimpan data editor:', error);
                alert('Terjadi kesalahan saat menyimpan konten.');
            });
        });
    }

    // Untuk tombol cancel (jika ada)
    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back();
        });
    }

}); 