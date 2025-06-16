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
                class="p-4 shadow-[0px_0px_4px_1px_rgba(0,0,0,0.4)] font-bold flex bg-gray-100 flex-row justify-between sticky top-0">
                <div class="text-3xl font-bold pl-4">Management Course</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>
            <div class="w-full flex pt-6 pb-2 px-6 justify-between">
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
                        <select name="category" id="category" class="min-w-56 focus:outline-none px-2 text-gray-900">
                            <option value="writer" class="min-w-56 gray-900">
                                All Category
                            </option>
                        </select>
                    </div>
                    <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                        <i class="fas fa-search text-gray-500"></i>
                        <select name="category" id="category" class="min-w-42 focus:outline-none px-2 text-gray-900">
                            <option value="writer" class="min-w-56 gray-900">
                                Status
                            </option>
                        </select>
                    </div>
                </div>
                <div class="">
                    <a href="course/create" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
                            class="fas fa-plus text-gray-50"></i> Add Content</a>
                </div>

            </div>
            <div class="p-4 flex flex-cols-3 justify-around gap-4">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">All Course</div>
                        <div class="text-3xl text-indigo-700">24</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-200 h-10 w-10 m-4">
                        <i class="fas fa-book text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
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
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Drafted Course</div>
                        <div class="text-3xl text-amber-500 pl-4"></div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-pencil text-2xl text-amber-500"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-around">
                @foreach ($courses as $course)
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div class="p-2 h-52 w-full items-start flex justify-between  bg-cover bg-center"
                            style="background-image: url('https://picsum.photos/900/600?random={{ $course->id }}');">

                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-gray-900">
                                {{ $course->created_at->diffForHumans() }}
                            </div>
                            @if ($course->status)
                                <div class="rounded-4xl bg-green-600 py-1 px-2 text-xs text-gray-200">Published
                                </div>
                            @else
                                <div class="rounded-4xl bg-red-600 py-1 px-2 text-xs text-gray-200">Draft
                                </div>
                            @endif
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col justify-around mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900 self-start">
                                    {{ $course->category->category }}
                                </div>
                                <div class="relative inline-block text-left">
                                    <div>
                                        <button type="button"
                                            class="js-dropdown-button inline-flex justify-center w-full rounded-md p-2 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                            aria-haspopup="true" aria-expanded="true">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="dropdown-menu"
                                        class="js-dropdown-menu hidden origin-top-right absolute shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] right-0 mt-2 w-56 rounded-md bg-gray-100 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                                        <div class="py-1" role="none">
                                            <a href="#"
                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
                                                role="menuitem" id="menu-item-0">Edit Course</a>
                                            <a href="{{ url('admin/course/' . $course->slug) }}"
                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
                                                role="menuitem" id="menu-item-1">Show more</a>
                                            <a href="#"
                                                class="text-red-600 block px-4 py-2 text-sm hover:bg-gray-300"
                                                role="menuitem" id="menu-item-2">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">
                                {{ $course->title }}</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">
                                {{ $course->description }}</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        {{ substr($course->user->name, 0, 1) }}</div>
                                    <div class="pl-2 text-sm text-gray-600">{{ $course->user->name }}</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                {{-- <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-52 w-full items-start flex justify-between  bg-[url('https://picsum.photos/902/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-amber-200/60 py-1 px-2 text-xs text-gray-900">12 Month Ago</div>
                            <div class="rounded-4xl bg-green-600 py-1 px-2 text-xs text-gray-200">Published</div>
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-amber-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-amber-500 text-amber-100 justify-center flex items-center">
                                        P</div>
                                    <div class="pl-2 text-sm text-gray-700">Prawowo</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-amber-500"></i>
                                    <div class="text-sm text-gray-600">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-52 w-full items-start flex justify-between  bg-[url('https://picsum.photos/901/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-green-200/60 py-1 px-2 text-xs text-gray-900">12 Month Ago</div>
                            <div class="rounded-4xl bg-red-600 py-1 px-2 text-xs text-gray-100">Draft</div>
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-green-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-green-700 text-green-100 justify-center flex items-center">
                                        P</div>
                                    <div class="pl-2 text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-green-700"></i>
                                    <div class="text-sm text-gray-700">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-52 w-full items-start flex justify-between  bg-[url('https://picsum.photos/901/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-green-200/60 py-1 px-2 text-xs text-gray-900">12 Month Ago</div>
                            <div class="rounded-4xl bg-red-600 py-1 px-2 text-xs text-gray-100">Draft</div>
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-green-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-green-700 text-green-100 justify-center flex items-center">
                                        P</div>
                                    <div class="pl-2 text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-green-700"></i>
                                    <div class="text-sm text-gray-700">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-52 w-full items-start flex justify-between  bg-[url('https://picsum.photos/900/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-gray-900">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-green-600 py-1 px-2 text-xs text-gray-200">Published</div>
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="pl-2 text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div
                        class=" bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl flex flex-col justify-between items-center overflow-hidden">
                        <div
                            class="p-2 h-52 w-full items-start flex justify-between  bg-[url('https://picsum.photos/906/600')] bg-cover bg-center">
                            <div class="rounded-4xl bg-indigo-200/60 py-1 px-2 text-xs text-gray-900">12 Month Ago
                            </div>
                            <div class="rounded-4xl bg-green-600 py-1 px-2 text-xs text-gray-200">Published</div>
                        </div>
                        <div class="h-46 w-full p-2 flex flex-col mt-2">
                            <div class="flex justify-between">
                                <div class="rounded-4xl bg-indigo-200 py-1 px-2 text-xs text-gray-900"> Web Development
                                </div>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </div>
                            <div class="pl-2 pt-2 font-semibold line-clamp-2 text-lg text-gray-900">Tutorial Laravel 12
                                100% work no debat dan pasti berhasil realllllll pasti bisa yakn betul html dan lain
                                lain</div>
                            <div class="pl-2 pt-2 text-sm text-gray-500 line-clamp-2">Pelajari laravel 12 dengan
                                sungguh-sungguh
                                maka anda akan aman dan sehat sentosa</div>
                            <div class="flex justify-between">
                                <div class="flex items-center pt-2 pl-2">
                                    <div
                                        class="rounded-full h-6 w-6 bg-indigo-700 text-indigo-200 justify-center flex items-center">
                                        P</div>
                                    <div class="pl-2 text-sm text-gray-600">Prawowo</div>
                                </div>
                                <div class="flex items-center pt-2 gap-2">
                                    <i class="fas fa-users-line text-indigo-700"></i>
                                    <div class="text-sm text-gray-600">0.5% Participant</div>
                                </div>
                            </div>

                        </div>
                    </div> --}}

            </div>
            <div class="mt-4">
                {{ $courses->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const allDropdownButtons = document.querySelectorAll('.js-dropdown-button');


        allDropdownButtons.forEach(button => {
            button.addEventListener('click', (event) => {

                event.stopPropagation();
                const dropdownContainer = button.closest('.relative');
                const dropdownMenu = dropdownContainer.querySelector('.js-dropdown-menu');


                const isMenuOpen = !dropdownMenu.classList.contains('hidden');


                document.querySelectorAll('.js-dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });

                if (!isMenuOpen) {
                    dropdownMenu.classList.remove('hidden');
                }

            });
        });

        window.addEventListener('click', () => {
            document.querySelectorAll('.js-dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

    });
</script>

</html>
