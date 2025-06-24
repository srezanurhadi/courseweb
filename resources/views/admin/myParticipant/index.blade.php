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
                <div class="text-3xl font-bold pl-4">My Participant</div>
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
                            @foreach ($courses as $course)
                                <tr class="bg-white border-t hover:bg-gray-50 ">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="ml-4 w-full">
                                                <div
                                                    class="text-lg font-semibold text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                    {{ $course->title }}</div>
                                                <div
                                                    class="text-sm text-gray-700 truncate overflow-hidden whitespace-nowrap max-w-[700px]">
                                                    {{ $course->description }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="pl-6 py-4">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full  text-gray-800">
                                            {{ $course->enrollments_count }} Participant
                                        </span>
                                    </td>
                                    <td class="pr-6 py-4">
                                        <a href="{{ url('admin/myparticipant/' . $course->slug) }}">
                                            <button id="show"
                                                class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center hover:cursor-pointer"
                                                aria-label="show">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
