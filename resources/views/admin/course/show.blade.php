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
            <div class="w-full bg-gray-50 flex flex-col">
                <div
                    class="z-50 p-4 shadow-[0px_0px_4px_1px_rgba(0,0,0,0.4)] font-bold flex bg-gray-100 flex-row justify-between sticky top-0">
                    <div class="text-3xl font-bold pl-4">Preview Course</div>
                    <div class="profile flex items-center gap-2 pr-4">
                        <i class="fas fa-bell text-xl"></i>
                        <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                            <span class="text-xl">A</span>
                        </div>
                        <div class="">Admin</div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full flex gap-2 items-center p-3 pl-6 font-semibold">
                        <div class="  text-indigo-700"> <i class="fa-solid fa-play rotate-180"></i><span
                                class="pl-2">Back</span>
                        </div>
                        <div class=" py-0.5 px-3 border-amber-500 text-amber-500 bg-amber-100 rounded-sm border-2">
                            <i class="fas fa-pencil-alt"></i> <span class="pl-2">Edit</span>
                        </div>
                        <div class=" py-0.5 px-3 border-rose-500 text-rose-500 bg-rose-100 rounded-sm border-2">
                            <i class="fas fa-trash"></i> <span class="pl-2">Delete</span>
                        </div>
                    </div>
                </div>
                    <div class="w-full bg-indigo-100/80 rounded-lg">
                        <div class="flex flex-row">
                            <div class="w-1/3 flex flex-col px-8 pt-8 ">
                                <div class="w-68 flex flex-col items-center">
                                    <div
                                        class="aspect-4/3 w-full h-full bg-[url('https://picsum.photos/900/600')] bg-cover bg-center rounded-md">
                                    </div>
                                    <div class="pt-2 font-semibold text-gray-800">Course By:</div>
                                    <div class="flex items-center p-2 gap-2">
                                        <div
                                            class="rounded-full h-6 w-6 p-1 text-gray-50 bg-amber-500 flex items-center justify-center">
                                            J
                                        </div>
                                        <div class="text-gray-800 text-sm">{{ $course->user->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-2/3 flex flex-col py-8 pr-8 ">
                                @if ($course->status)
                                    <div class="px-3 text-xs bg-green-600 rounded-2xl self-end text-gray-50">Published
                                    </div>
                                @else
                                    <div class="px-3 text-xs bg-rose-600 rounded-2xl self-end text-gray-50">Draft
                                    </div>
                                @endif
                                <div class="flex gap-8">
                                    <div class="p-1 text-xs bg-indigo-200 rounded-2xl text-indigo-700">
                                        {{ $course->category->category }}
                                    </div>
                                    <div class="flex items-center pt-1 gap-2">
                                        <i class="fas fa-users-line text-indigo-700"></i>
                                        <div class="text-sm text-gray-600">0.5% Participant</div>
                                    </div>
                                </div>
                                <div class="pt-2 text-4xl font-bold">{{ $course->title }}</div>
                                <div class="pt-2 text-md/5 line-clamp-6">{{ $course->description }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around w-full p-8 gap-8">
                        <div
                            class="w-1/3 h-58 overflow-y-auto px-2 pb-2 rounded-lg shadow-[0px_0px_4px_1px_rgba(0,0,0,0.4)] bg-indigo-50">
                            <div class="text-2xl font-semibold sticky top-0 bg-indigo-50 pt-2 z-10">Content</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">1. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">2. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">3. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">4. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">5. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">6. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">7. why do we choose figma?</div>
                            <div class="font-semibold pl-2 py-1 line-clamp-2">8. why do we choose figma?</div>
                        </div>
                        <div class="w-2/3 flex flex-col justify-between">
                            <div class="p-4 rounded-lg shadow-[0px_0px_4px_1px_rgba(0,0,0,0.4)] bg-indigo-50">
                                <div class="text-2xl font-semibold">Why do we choose figma?</div>
                                <div class="text-md/5 line-clamp-5 text-ellipsis">Lorem ipsum dolor sit amet,
                                    consectetur
                                    adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    Ut
                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                    ea
                                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum
                                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                    sunt in
                                    culpa qui officia deserunt mollit anim id est laborum.</div>
                            </div>
                            <Div class="flex justify-between">
                                <div class="py-1 px-2 w-22 text-center rounded-lg bg-indigo-700 text-white">previous
                                </div>
                                <div class=""> 1 2 3 4</div>
                                <div class="py-1 px-2 w-22 text-center rounded-lg bg-indigo-700 text-white">next</div>
                            </Div>
                        </div>
                    </div>
            </div>
        </div>
    </body>

    </html>
