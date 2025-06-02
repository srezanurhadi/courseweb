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
    <div class="flex flex-1 ">
        <x-sidebar></x-sidebar>
        <div class="w-full bg-gray-50 flex flex-col p-4">
            <form action="/submit-content" method="POST" id="contentForm">
                <div
                    class="bg-gray-100 h-full p-4 pl-6 rounded-lg shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-2">
                    <h1 class="font-bold text-3xl pt-2 text-center">Create New Content</h1>

                    <div class="mb-4">
                        <label for="title" class="text-sm font-medium text-gray-700 block mb-1">Content Title<span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title"
                            class="w-full px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:border-indigo-500"
                            required aria-required="true">
                    </div>

                    <div class="mb-4 ">
                        <label for="description" class="text-sm font-medium text-gray-700 block mb-1">Course
                            Description<span class="text-red-500">*</span></label>
                        <div id="editor" class="w-full bg-gray-50 border-2 border-gray-300 h" style="height:200px;">
                        </div>
                        <input type="hidden" name="description" id="hidden_description">
                    </div>

                    <div class="mb-4">
                        <label for="category" class="text-sm font-medium text-gray-700 block mb-1">Course Category<span
                                class="text-red-500">*</span></label>
                        <select name="category" id="category"
                            class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2 text-sm text-gray-700 focus:outline-none focus:border-indigo-500"
                            required aria-required="true">
                            <option value="" disabled selected>Choose Category</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <div class="flex flex-row justify-end gap-4">
                            <button type="button" id="cancelButton"
                                class="py-2 px-6 text-indigo-700 bg-gray-50 border-2 border-indigo-700 rounded-lg text-center hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </button>
                            <button type="submit"
                                class="py-2 px-6 text-gray-50 bg-indigo-700 border-2 border-indigo-700 rounded-lg text-center hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow', // Tema 'snow' (dengan toolbar) atau 'bubble'
            placeholder: 'Tulis deskripsi kursus di sini...',
            modules: {
                toolbar: [ // Kustomisasi toolbar sesuai kebutuhan
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                    ['image'], // Tambahkan 'image', 'video' jika perlu
                    ['clean'] // Tombol untuk menghapus format
                ]
            }
        });
    </script>
</body>
