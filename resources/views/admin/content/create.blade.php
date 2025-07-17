<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Content</title>

    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="flex flex-1 ">
        <x-sidebar></x-sidebar>
        <div class="w-full bg-gray-50 flex flex-col p-4 overflow-hidden">
            <form action="/{{ Auth::user()->role }}{{ Request::is('*/mycontent*') ? '/mycontent' : '/content' }}"
                method="POST" id="contentForm">
                @csrf
                <div
                    class="bg-gray-100 h-full p-4 pl-6 rounded-lg shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-2">
                    <h1 class="font-bold text-3xl pt-2">Create New Content</h1>

                    <div class="p-4">
                        <div class="mb-4">
                            <label for="title" class="text-sm font-medium text-gray-700 block mb-1">Content
                                Title<span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title"
                                class="w-full px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:border-indigo-500"
                                required>
                        </div>

                        <div class="mb-4 flex flex-col flex-1">
                            <label class="text-sm font-medium text-gray-700 block mb-1">Content <span
                                    class="text-red-500">*</span></label>

                            <div id="editorjs-wrapper"
                                class="bg-white border-2 border-gray-300 rounded-md flex-1 min-h-[300px]">
                                <div id="editorjs" data-role="{{ Auth::user()->role }}" class="px-10"></div>
                            </div>
                            <input type="hidden" name="content" id="editor_content">
                        </div>
                        <div class="mb-4">
                            <label for="category" class="text-sm font-medium text-gray-700 block mb-1">Content
                                Category<span class="text-red-500">*</span></label>
                            <select name="category" id="category"
                                class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2 text-sm text-gray-700 focus:outline-none focus:border-indigo-500"
                                required>
                                <option value="" disabled selected>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6">
                            <div class="flex flex-row justify-end gap-4">
                                <button type="button" id="cancelButton"
                                    class="py-2 px-6 text-indigo-700 bg-gray-50 border-2 border-indigo-700 shadow-sm rounded-lg text-center hover:shadow-none hover:bg-gray-100 transition-all duration-300 cursor-pointer">Cancel</button>
                                <button type="submit"
                                    class="py-2 px-6 text-gray-50 bg-indigo-700 border-2 border-indigo-700  shadow-sm rounded-lg text-center hover:shadow-none hover:bg-indigo-800 transition-all duration-300 cursor-pointer">Add
                                    Content</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @vite('resources/js/app.js')

</body>

</html>
