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
            <div class="w-full bg-gray-50 flex flex-col">
                <form action="">
                    <div
                        class="bg-gray-100 h-full m-4 p-4 pl-6 rounded-lg shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] flex flex-col gap-2">
                        <h1 class="font-bold text-3xl pt-2">Create New Course</h1>
                        <div class="mb-4">
                            <label for="title" class="text-sm">Course Title<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title"
                                class="w-full
                                px-3 py-2 border-2 border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar
                                Galeri <span class="text-red-500">*</span></label>
                            <div
                                class="mt-1 w-100 h-75 flex justify-center items-center px-6 pt-5 pb-6 border-2 bg-gray-50 border-gray-300 border-dashed rounded-md">
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
                                <p class="text-sm font-medium text-gray-700 mb-2">Pratinjau Gambar:</p>
                                <img id="preview-img"
                                    class="w-2xs h-64 object-cover object-center border-2 border-gray-400 rounded-md"
                                    alt="Image preview" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="text-sm">Course Description<span
                                    class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg" placeholder=""></textarea>
                        </div>
                        <div class="mb-4">
                            <div
                                class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg flex flex-col justify-center items-center p-4">
                                <div class="flex flex-row justify-between w-full">
                                    <label for="course-content" class="text-sm">Course Content<span
                                            class="text-red-500">*</span></label>
                                    <div class="text-sm rounded-lg bg-indigo-700 text-gray-50 p-2">+ add course</div>
                                </div>
                                <div class="text-sm text-gray-700 p-4">No content add yet. click "Add Content" to Add
                                    course materials</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="text-sm">Course Category<span
                                    class="text-red-500">*</span></label>
                            <select name="category" id="category"
                                class="w-full bg-gray-50 border-2 border-gray-300 rounded-lg p-2 text-sm text-gray-700">
                                <option value="">Choose Category
                                </option>
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
                                <div class="py-2 w-34 text-indigo-700 bg-gray-50 border-2 border-indigo-700 rounded-lg text-center">Cancel</div>
                                <div class="py-2 w-34 text-gray-50 bg-indigo-700 border-2 border-indigo-700 rounded-lg text-center">Save</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
