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
                <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between">
                    <div class="text-3xl font-bold pl-4">Management Course</div>
                    <div class="profile flex items-center gap-2 pr-4">
                        <i class="fas fa-bell text-xl"></i>
                        <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                            <span class="text-xl">A</span>
                        </div>
                        <div class="">Admin</div>
                    </div>
                </div>
                <div class="border-2 border-amber-300 p-4">fle</div>
                <div class="p-4 flex flex-cols-3 justify-around">
                    <div
                        class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-84 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">All Course</div>
                            <div class="text-3xl text-indigo-700">24</div>
                        </div>
                        <div
                            class="rounded-full text-indigo-200 justify-center flex items-center bg-gray-300 h-10 w-10 m-4">
                            <i class="fas fa-book text-2xl text-indigo-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-84 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col  font-semibold ">
                            <div class="text-base text-gray-800">Active Course</div>
                            <div class="text-3xl text-green-700 pl-4">20</div>
                        </div>
                        <div
                            class="rounded-full text-indigo-200 justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                            <i class="fas fa-check text-2xl text-green-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-84 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Drafted Course</div>
                            <div class="text-3xl text-amber-500 pl-4">24</div>
                        </div>
                        <div
                            class="rounded-full text-indigo-200 justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                            <i class="fas fa-pencil text-2xl text-amber-500"></i>
                        </div>
                    </div>
                </div>
                <div class="p-4 flex flex-cols-3 justify-around">
                    <div class="p-4 border-2 border-amber-400"></div>
                </div>
            </div>
        </div>
    </body>

    </html>
