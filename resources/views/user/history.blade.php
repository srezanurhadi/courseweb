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
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- - Navbar - --}}
            <nav class="bg-white shadow-md z-50 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">History</h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        {{-- Jika user punya foto, tampilkan foto --}}
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan inisial --}}
                                        <span class="text-xl font-semibold leading-none text-gray-700">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </span>
                                <span class="text-xl font-semibold text-gray-700">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- - Content Area - --}}
            <div class="relative flex-grow">
                <header
                    class="bg-indigo-100 h-[50px] rounded-b-3xl mb-4 flex justify-center items-center relative overflow-hidden">
                </header>

                <div class="absolute top-[25px] left-1/2 transform -translate-x-1/2">
                    <div class="bg-white rounded-3xl shadow-md py-3 px-5 flex items-center">
                        <div class="flex items-center gap-3">
                            <form class="flex items-center gap-2">
                                <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 pl-2">
                                    <i class="fas fa-search text-gray-500"></i>
                                    <input type="text"
                                        class="rounded-lg w-48 focus:outline-none px-2 placeholder:font-semibold placeholder:italic text-gray-400"
                                        placeholder="Search Content...">
                                </div>

                                <button class="bg-sky-600 px-2 rounded-3xl">
                                    <p class=" font-medium text-base text-white">Search</p>
                                </button>
                            </form>
                            <div class="w-[1px] h-[30px] bg-gray-300"></div>
                            <p class="flex items-center font-medium text-base text-gray-900 whitespace-nowrap">Choose
                                Category :</p>
                            <div class=" flex gap-1 items-center rounded-3xl border-gray-300 border-2 px-2">
                                <i class="fas fa-search text-gray-500"></i>
                                <select name="category" id="category"
                                    class="w-40 focus:outline-none px-2 text-gray-900">
                                    <option value="all" class="text-gray-900">
                                        All Category
                                    </option>
                                    <option value="uiux" class="text-gray-900">
                                        UI/UX Design
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-10 p-4 grid grid-cols-4 gap-10 justify-around">
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-40 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-indigo-700">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-indigo-700">12 Pages</div>
                        </div>
                        <div class="w-full p-2 flex flex-col mt-2">
                            <div class="self-start">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                            </div>
                            <a href="{{ route('user.course.overview') }}"
                                class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900 hover:text-indigo-900 cursor-pointer">
                                Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</a>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex-col space-y-2 m-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">30 Participant</div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>

</body>

</html>
