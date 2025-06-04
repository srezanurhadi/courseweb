<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="h-screen flex">
        <!-- Sidebar dengan fixed position -->
        <div class="fixed top-0 left-0 h-full w-64">
            <x-sidebar></x-sidebar>
        </div>

        <!-- Konten utama dengan padding-left untuk mengkompensasi sidebar -->
        <div class="flex-grow flex flex-col pl-54"> <!-- pl-64 harus sama dengan lebar sidebar -->
            <!-- Navbar -->
            <nav class="bg-white shadow-md z-10 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300">
                                    <span class="text-xl font-semibold leading-none text-gray-700">A</span>
                                </span>
                                <span class="text-xl font-semibold text-gray-700">User</span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-grow p-6 bg-gray-100">
                <!-- Profile Section -->
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl">
                        <!-- Profile Title positioned outside section but aligned with content -->
                        <div class="mb-2">
                            <h2 class="text-xl font-bold text-gray-800">Profile</h2>
                        </div>

                        <section class="mb-8 rounded-md border border-gray-300 shadow-md bg-white">
                            <!-- Profile content -->
                            <div class="p-4 lg:p-6 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                <!-- Profile Form -->
                                <div class="flex-1 w-full">
                                    <form class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full max-w-2xl">
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="fullname">Full
                                                Name</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="fullname" type="text" value="Roro Jonggrang" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="email">Email</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="email" type="email" value="rorojonggrang@gmail.com"
                                                readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="handphone">Handphone</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="handphone" type="text" value="081234567890" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none"
                                                for="role">Role</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="role" type="text" value="Participant" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="joindate">Join
                                                Date</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="joindate" type="text" value="2020" readonly />
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="text-sm font-semibold mb-1 select-none" for="enddate">End
                                                Date</label>
                                            <input
                                                class="border border-gray-400 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-full max-w-xs"
                                                id="enddate" type="text" value="-" readonly />
                                        </div>
                                        <div class="col-span-full mt-4">
                                            <a href="{{ route('user.profile.edit') }}"
                                                class="text-indigo-700 border border-indigo-700 rounded-md px-8 py-2 text-sm font-semibold hover:bg-indigo-700 hover:text-white transition-colors">Edit</a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Profile Photo Section - Now on the right side -->
                                <div class="flex flex-col items-center gap-4 lg:w-1/3 order-first lg:order-last">
                                    <div class="relative">
                                        <div
                                            class="w-32 h-32 sm:w-54 sm:h-54 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden">
                                            <!-- Initials as fallback -->
                                            <span class="text-3xl sm:text-4xl font-semibold text-indigo-700">RJ</span>
                                        </div>
                                        <button
                                            class="absolute bottom-0 right-0 bg-white rounded-full p-3 shadow-md hover:bg-gray-100">
                                            <i class="fas fa-camera text-indigo-700 text-md"></i>
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-lg font-semibold text-gray-800">Roro Jonggrang</h3>
                                        <p class="text-sm text-gray-500">Participant</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Course Table Section -->
                <div class="flex justify-center px-4 lg:px-16">
                    <div class="w-full max-w-6xl">
                        <!-- Course Title positioned outside section but aligned with content -->
                        <div class="mb-2">
                            <h2 class="text-xl font-bold text-gray-800">Course Progress</h2>
                        </div>

                        <section class="mb-8 rounded-md border border-gray-300 shadow-md bg-white">

                            <!-- Table Content -->
                            <div class="overflow-hidden rounded-md">
                                <!-- Table Header -->
                                <div class="bg-indigo-700 text-white rounded-t-md">
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 p-2.5 font-semibold text-xs sm:text-sm">
                                        <div>Course Name</div>
                                        <div class="hidden sm:block">Progress</div>
                                        <div class="text-center">Status</div>
                                        <div class="text-center">About</div>
                                    </div>
                                </div>

                                <!-- Table Rows -->
                                <div class="divide-y divide-gray-200">
                                    <!-- Row 1 -->
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 p-3 sm:p-4 items-center bg-gray-50">
                                        <div class="font-semibold text-gray-800 text-sm">Introducing to Figma</div>
                                        <div class="hidden sm:flex items-center gap-2">
                                            <div class="flex-1 bg-gray-300 rounded-full h-2">
                                                <div class="bg-indigo-700 h-2 rounded-full" style="width: 100%"></div>
                                            </div>
                                            <span class="text-sm text-gray-700">100%</span>
                                        </div>
                                        <div class="flex justify-center">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Finished
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('user.course.detail', ['id' => 1]) }}"
                                                class="text-indigo-700 hover:underline text-sm font-medium">Detail</a>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 p-3 sm:p-4 items-center bg-gray-50">
                                        <div class="font-semibold text-gray-800 text-sm">Internet Introduction</div>
                                        <div class="hidden sm:flex items-center gap-2">
                                            <div class="flex-1 bg-gray-300 rounded-full h-2">
                                                <div class="bg-indigo-700 h-2 rounded-full" style="width: 90%"></div>
                                            </div>
                                            <span class="text-sm text-gray-700">90%</span>
                                        </div>
                                        <div class="flex justify-center">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Ongoing
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-gray-500 text-sm font-medium">Detail</span>
                                        </div>
                                    </div>

                                    <!-- Row 3 -->
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 p-3 sm:p-4 items-center bg-gray-50">
                                        <div class="font-semibold text-gray-800 text-sm">Understanding Data</div>
                                        <div class="hidden sm:flex items-center gap-2">
                                            <div class="flex-1 bg-gray-300 rounded-full h-2">
                                                <div class="bg-indigo-700 h-2 rounded-full" style="width: 50%"></div>
                                            </div>
                                            <span class="text-sm text-gray-700">50%</span>
                                        </div>
                                        <div class="flex justify-center">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Ongoing
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-gray-500 text-sm font-medium">Detail</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
