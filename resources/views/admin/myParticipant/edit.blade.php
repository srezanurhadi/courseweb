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

            <div class="px-24 pt-6">
                <div class="font-semibold text-lg">Profile</div>
                <div class="font-semibold shadow-[0px_0px_6px_1px_rgba(0,0,0,0.4)] p-6 text-gray-800 bg-gray-100">
                    <div class="flex justify-around gap-6">
                        <div class="flex flex-col gap-1 text-left w-1/3">
                            <div>Full Name</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">Roro Jonggrang</div>
                            <div class="pt-2">Handphone</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">08213475894</div>
                            <div class="pt-2">Join date</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">2020</div>
                        </div>
                        <div class="flex flex-col gap-1 text-left w-1/3">
                            <div class="">Email</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">timunmas123@gmail.com</div>
                            <div class="pt-2">Role</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">Participant</div>
                            <div class="pt-2">End Date</div>
                            <div class="p-2 border-2 border-gray-400 rounded-md">-</div>
                        </div>
                        <div class="w-1/3 flex justify-center items-center">
                            <div
                                class="w-48 h-48 border-2 rounded-full bg-indigo-200 bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-24 py-4">
                <div class="font-semibold text-lg">Profile</div>
                <div class="font-semibold shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] p-4 text-gray-800 bg-gray-100 justify-center items-center">
                    <div class="flex justify-around gap-6 pt-4">
                        <div class="flex flex-col justify-center items-center gap-1 text-left w-1/2">
                            <div class="">Mark is :</div>
                            <div class="">
                                <span class="text-[150px] leading-[150px]">98</span>
                            </div>
                        </div>
                        <div class="w-1/2 flex justify-center items-center">
                            <div
                                class="w-62 h-48 rounded-md bg-indigo-200 bg-[url('https://picsum.photos/900/601')] bg-cover bg-center">
                            </div>
                        </div>
                    </div>
                    <div class="w-34 place-self-center text-center p-1 rounded-md bg-gray-50 text-indigo-700 border-2 border-indigo-700">Edit</div>
                </div>
            </div>



        </div>
    </div>
</body>


</html>
