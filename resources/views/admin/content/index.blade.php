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
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class=" w-full bg-gray-50 ">
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky">
                <div class="text-3xl font-bold pl-4">Management Course</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>
            <div class="w-full flex pt-8 px-4 justify-between">
                <div class="flex gap-4">
                    <form class="flex gap-2">
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text"
                                class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic"
                                placeholder="Search Content...">
                        </div>

                        <button class="bg-sky-600 px-2 rounded-lg">
                            <p class=" font-medium text-base text-white">search</p>
                        </button>
                    </form>
                    <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                        <i class="fas fa-search text-gray-500"></i>
                        <select name="category" id="category" class="min-w-56 focus:outline-none px-2 text-gray-900 ">
                            <option value="writer" class="min-w-56 ">
                                All category
                            </option>
                        </select>

                    </div>
                </div>
                <div class="">
                    <a href="content/create" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
                            class="fas fa-plus text-gray-50"></i> Add Content</a>
                </div>

            </div>
            <div class="p-4 flex justify-around gap-2  ">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">All Content</div>
                        <div class="text-3xl text-indigo-700 pl-4">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                        <i class="fas fa-book text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col  font-semibold ">
                        <div class="text-base text-gray-800">Categories</div>
                        <div class="text-3xl text-green-700 pl-4">20</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-tag text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Used</div>
                        <div class="text-3xl text-amber-500 pl-4">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-check text-2xl text-amber-500"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-rose-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Unused</div>
                        <div class="text-3xl text-rose-500 pl-4">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-rose-200 h-10 w-10 m-4">
                        <i class="fas fa-x text-2xl text-rose-500"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 relative">
                <div class="bg-gray-50 shadow-lg rounded-xl overflow-hidden pb-5">
                    {{-- header --}}
                    <div class="flex bg-indigo-600 text-gray-50 text-xs font-semibold uppercase tracking-wider">
                        <div class="px-6 py-3 w-4/12 text-left">Judul Konten</div>
                        <div class="px-6 py-3 w-2/12 text-left">Author</div>
                        <div class="px-6 py-3 w-2/12 text-left">Category</div>
                        <div class="px-6 py-3 w-2/12 text-left">Created At</div>
                        <div class="px-6 py-3 w-2/12 text-left">Action</div>
                    </div>
                    {{-- data --}}
                    <div class="space-y-4 px-4 py-4">
                        @foreach ($contents as $content)
                            <div class="flex items-center bg-amber-100 rounded-lg shadow-md text-sm font-medium">
                                <div class="px-6 py-3 w-4/12 text-gray-900">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-md bg-amber-500 flex items-center justify-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L1.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-.813 2.846a4.5 4.5 0 00-3.09 3.09zM18.25 12L17 14.25l-1.25-2.25L13.5 11l2.25-1.25L17 7.5l1.25 2.25L20.5 11l-2.25 1.25z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 truncate">
                                            {{ $content->title }} 
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">{{ optional($content->creator)->name ?? 'Tidak diketahui' }}</div>
                                <div class="px-6 py-3 w-2/12 text-gray-700 truncate">Laravel</div>
                                <div class="px-6 py-3 w-2/12 text-gray-700">{{ $content->created_at->format('d-m-Y') }}</div>
                                <div class="px-6 py-3 w-2/12">
                                    <div class="flex items-center space-x-2">
                                        <a href="content/{{ $content->slug }}"
                                            class="w-8 h-8 rounded-sm bg-sky-500 hover:bg-sky-600 text-white flex items-center justify-center"
                                            aria-label="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button
                                            class="w-8 h-8 rounded-sm bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center"
                                            aria-label="Ubah">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button
                                            class="w-8 h-8 rounded-sm bg-red-500 hover:bg-red-600 text-white flex items-center justify-center"
                                            aria-label="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
</body>
<script></script>

</html>
