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
    <div class="flex flex-1 h-screen"> {{-- Ditambahkan h-screen untuk memastikan flex container mengisi tinggi layar --}}
        <x-sidebar></x-sidebar>
        <div class="w-full bg-gray-50 relative h-full overflow-y-auto">

            {{-- Header yang Sticky --}}
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-30">
                <div class="text-3xl font-bold pl-4">Management Course</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            {{-- search --}}
            <div class="w-full flex pt-8 pb-4 px-4 justify-center">
                <div class="flex gap-4">
                    <form class="flex gap-2">
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text"
                                class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic bg-transparent"
                                {{-- Ditambahkan bg-transparent jika input di dalam bg-gray-50 --}} placeholder="Search User...">
                        </div>
                        <button class="bg-sky-600 px-2 rounded-lg">
                            <p class=" font-medium text-base text-white">search</p>
                        </button>
                    </form>
                </div>
            </div>

            {{-- head --}}
            <div class="p-4 flex justify-between gap-8">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Total Course</div>
                        <div class="text-3xl text-indigo-700 pl-4">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                        <i class="fas fa-users text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Total Participant</div>
                        <div class="text-3xl text-green-700 pl-4">20</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-user text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Avg. Participant</div>
                        <div class="text-3xl text-amber-500 pl-4">15</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-user-tie text-2xl text-amber-500"></i>
                    </div>
                </div>
            </div>

            {{-- tabel --}}
            <div class="container mx-auto p-4">
                <div class="overflow-x-auto shadow-md sm:rounded-lg w-full">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-white bg-indigo-600 ">
                            <tr>
                                <th scope="col" class="pr-6 pl-10 py-3 w-3/4">Course Name</th>
                                <th scope="col" class="pl-6 py-3 1/6">Total Participant</th>
                                <th scope="col" class="pr-6 py-3 1/6">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh Baris Tabel --}}
                            <tr class="bg-white border-t hover:bg-gray-50 ">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4 w-full">
                                            <div
                                                class="text-xl font-semibold text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[650px]">
                                                Tutorial Laravel 12 Mantap jos gandoss mantap pollllll anda mahis
                                                laravle dalam 3 menit pertama Laravel 12 Mantap jos gandoss mantap
                                                pollllll ya jelas karena dia oke banget wkwkwkwk</div>
                                            <div
                                                class="text-sm text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial ini akan membuat anda mahis laravle dalam 3 menit pertama
                                                Laravel 12 Mantap jos gandoss mantap pollllll ya jelas karena dia oke
                                                banget wkwkwkwk</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="pl-6 py-4">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full  text-gray-800">
                                        25 Participant
                                    </span>
                                </td>
                                <td class="pr-6 py-4">
                                    <button id="show"
                                        class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                        aria-label="show">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-white border-t hover:bg-gray-50 ">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4 w-full">
                                            <div
                                                class="text-xl font-semibold text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial Laravel 12 Mantap jos gandoss mantap pollllll anda mahis
                                                laravle dalam 3 menit pertama Laravel 12 Mantap jos gandoss mantap
                                                pollllll ya jelas karena dia oke banget wkwkwkwk</div>
                                            <div
                                                class="text-sm text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial ini akan membuat anda mahis laravle dalam 3 menit pertama
                                                Laravel 12 Mantap jos gandoss mantap pollllll ya jelas karena dia oke
                                                banget wkwkwkwk</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="pl-6 py-4">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full  text-gray-800">
                                        25 Participant
                                    </span>
                                </td>
                                <td class="pr-6 py-4">
                                    <button id="show"
                                        class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                        aria-label="show">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-white border-t hover:bg-gray-50 ">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4 w-full">
                                            <div
                                                class="text-xl font-semibold text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial Laravel 12 Mantap jos gandoss mantap pollllll anda mahis
                                                laravle dalam 3 menit pertama Laravel 12 Mantap jos gandoss mantap
                                                pollllll ya jelas karena dia oke banget wkwkwkwk</div>
                                            <div
                                                class="text-sm text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial ini akan membuat anda mahis laravle dalam 3 menit pertama
                                                Laravel 12 Mantap jos gandoss mantap pollllll ya jelas karena dia oke
                                                banget wkwkwkwk</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="pl-6 py-4">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full  text-gray-800">
                                        25 Participant
                                    </span>
                                </td>
                                <td class="pr-6 py-4">
                                    <button id="show"
                                        class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                        aria-label="show">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-white border-t hover:bg-gray-50 ">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4 w-full">
                                            <div
                                                class="text-xl font-semibold text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial Laravel 12 Mantap jos gandoss mantap pollllll anda mahis
                                                laravle dalam 3 menit pertama Laravel 12 Mantap jos gandoss mantap
                                                pollllll ya jelas karena dia oke banget wkwkwkwk</div>
                                            <div
                                                class="text-sm text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                Tutorial ini akan membuat anda mahis laravle dalam 3 menit pertama
                                                Laravel 12 Mantap jos gandoss mantap pollllll ya jelas karena dia oke
                                                banget wkwkwkwk</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="pl-6 py-4">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full  text-gray-800">
                                        25 Participant
                                    </span>
                                </td>
                                <td class="pr-6 py-4">
                                    <button id="show"
                                        class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                        aria-label="show">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            {{-- modal start --}}
            <div class="">
                <div id="modal"
                    class="modal hidden opacity-0 absolute inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">

                    {{-- Konten Modal --}}
                    <div
                        class="min-w-full bg-slate-100 rounded-lg pl-15 p-3  max-h-[90vh] flex flex-col gap-4 overflow-y-auto">
                        <div class="flex justify-end relative">
                            <button id="closeModal" class="text-red-500 hover:text-red-700 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <div class=" w-2/3">
                                <div class="mb-2">
                                    <div for="full-name" class="block text-gray-700 text-sm font-bold mb-2">Full
                                        Name</div>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        Roro Jonggrang
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                        class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        rorojonggrang@gmail.com
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="handphone"
                                        class="block text-gray-700 text-sm font-bold mb-2">Handphone</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        081234567890
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="role"
                                        class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        Author
                                    </div>
                                </div>
                            </div>
                            <div class="  w-1/3 flex justify-center items-start">
                                <div class="relative ">
                                    <div
                                        class="rounded-full size-62 bg-gray-300 flex items-center justify-center overflow-hidden">
                                        {{-- Placeholder untuk foto profil --}}
                                        <svg class="w-20 h-20 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <button
                                        class="absolute bottom-0 right-0 bg-gray-200 rounded-full p-1 hover:bg-gray-300 focus:outline-none focus:shadow-outline">
                                        <svg class="size-10 text-gray-700" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0010.07 4h3.86a2 2 0 001.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="block text-gray-700 text-sm font-bold mb-2">Course Created</h2>
                            <div
                                class="bg-indigo-100  p-2 rounded-lg border-2 border-indigo-300 overflow-y-auto h-50 course-created-scrollable">
                                <ul class="space-y-2">
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div id="modal"
                    class="modal hidden opacity-0 absolute inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">

                    {{-- Konten Modal --}}
                    <div
                        class="min-w-full bg-slate-100 rounded-lg pl-15 p-3  max-h-[90vh] flex flex-col gap-4 overflow-y-auto">
                        <div class="flex justify-end relative">
                            <button id="closeModal" class="text-red-500 hover:text-red-700 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <div class=" w-2/3">
                                <div class="mb-2">
                                    <div for="full-name" class="block text-gray-700 text-sm font-bold mb-2">Full
                                        Name</div>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        Roro Jonggrang
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                        class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        rorojonggrang@gmail.com
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="handphone"
                                        class="block text-gray-700 text-sm font-bold mb-2">Handphone</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        081234567890
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="role"
                                        class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                    <div
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        Author
                                    </div>
                                </div>
                            </div>
                            <div class="  w-1/3 flex justify-center items-start">
                                <div class="relative ">
                                    <div
                                        class="rounded-full size-62 bg-gray-300 flex items-center justify-center overflow-hidden">
                                        {{-- Placeholder untuk foto profil --}}
                                        <svg class="w-20 h-20 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <button
                                        class="absolute bottom-0 right-0 bg-gray-200 rounded-full p-1 hover:bg-gray-300 focus:outline-none focus:shadow-outline">
                                        <svg class="size-10 text-gray-700" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0010.07 4h3.86a2 2 0 001.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="block text-gray-700 text-sm font-bold mb-2">Course Created</h2>
                            <div
                                class="bg-indigo-100  p-2 rounded-lg border-2 border-indigo-300 overflow-y-auto h-50 course-created-scrollable">
                                <ul class="space-y-2">
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>
                                    <li class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                        <div class="flex items-center max-w-200 overflow-hidden">
                                            <div class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0"></div>
                                            <span class="truncate min-w-0">Tutorial Laravel 12 2024 mantap Lorem ipsum
                                                dolor sit amet consectetur adipisicing elit. Accusantium, modi? Ea est
                                                facere ad natus! Quos eaque nulla voluptatum aliquid, iste fugit quis
                                                est expedita incidunt possimus in, velit perspiciatis accusantium
                                                laudantium. Labore esse, laborum corrupti architecto consequuntur,
                                                molestias deserunt aspernatur omnis veritatis perferendis praesentium
                                                libero sit dicta et ad?</span>
                                        </div>
                                        <span class="text-sm text-gray-600">25 Konten</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal End --}}
        </div>
    </div>
</body>
<script>
    const modalOpen = document.querySelectorAll('#show');
    const modal = document.querySelectorAll('#modal');
    const modalClose = document.querySelectorAll('#closeModal');

    for (let i = 0; i < modalOpen.length; i++) {
        modalOpen[i].addEventListener('click', () => {
            modal[i].classList.remove('hidden');
            setTimeout(() => {
                modal[i].classList.remove('opacity-0')
            }, 10);


        });
        modalClose[i].addEventListener('click', () => {
            modal[i].classList.add('opacity-0');
            setTimeout(() => {
                modal[i].classList.add('hidden')
            }, 500);
        })
    }
</script>

</html>
