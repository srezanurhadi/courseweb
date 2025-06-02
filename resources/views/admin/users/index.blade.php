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
                    <a href="" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
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
            <div class="container mx-auto p-4">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-indigo-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Full Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="bg-purple-600 text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                B
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Bagus Pragoyo</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    Bagusprayogo15@gmail.com
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    085764324325
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Participant
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 rounded-md bg-yellow-100 hover:bg-yellow-200 text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="bg-purple-600 text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                B
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Bagus Pragoyo</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    Bagusprayogo15@gmail.com
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    085764324325
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Author
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 rounded-md bg-yellow-100 hover:bg-yellow-200 text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="bg-purple-600 text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                B
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Bagus Pragoyo</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    Bagusprayogo15@gmail.com
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    085764324325
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="p-2 rounded-md bg-yellow-100 hover:bg-yellow-200 text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>
<script></script>

</html>
