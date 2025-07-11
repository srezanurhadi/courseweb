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
                <div class="text-3xl font-bold pl-4">Management users</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8 overflow-hidden">

                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                class="aspect-square object-cover">
                        @else
                            <span class="text-xl">{{ Auth::user()->name[0] }}</span>
                        @endif

                    </div>
                    <div class="">{{ Auth::User()->name }}</div>
                </div>
            </div>

            {{-- search --}}
            <div class="w-full flex pt-8 px-4 justify-between">
                <div class="flex gap-4">
                    <form action="{{ url('/admin/users') }}" method="GET" class="flex gap-4" id="search-form">
                        <div class="flex gap-2">
                            {{-- Input Pencarian --}}
                            <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                                <i class="fas fa-search text-gray-500"></i>
                                <input type="text" name="search" {{-- [PENTING] Tambahkan atribut name --}}
                                    value="{{ request('search') }}" {{-- Menampilkan kembali keyword pencarian --}}
                                    class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic bg-transparent"
                                    placeholder="Search User...">
                            </div>

                            {{-- Dropdown Kategori --}}
                            <div class="flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                                <i class="fas fa-filter text-gray-500"></i> {{-- Mengganti ikon agar lebih sesuai --}}
                                <select name="category" id="category"
                                    class="min-w-56 focus:outline-none px-2 text-gray-900 bg-transparent"
                                    onchange="this.form.submit()"> {{-- [OPSIONAL] Otomatis submit saat kategori diubah --}}
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('category') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="author" {{ request('category') == 'author' ? 'selected' : '' }}>
                                        Author</option>
                                    <option value="participant"
                                        {{ request('category') == 'participant' ? 'selected' : '' }}>
                                        Participant</option>
                                </select>
                            </div>

                            {{-- Tombol Search --}}
                            <button type="submit" class="bg-sky-600 px-4 rounded-lg">
                                <p class="font-medium text-base text-white">Search</p>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="">
                    <a href="users/create" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i
                            class="fas fa-plus text-gray-50"></i> Add User</a>
                </div>
            </div>

            {{-- head --}}
            <div class="p-4 flex justify-around gap-2">
                <div
                    class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">All User</div>
                        <div class="text-3xl text-indigo-700 pl-4">{{ $userscount }}</div>
                    </div>
                    <div
                        class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                        <i class="fas fa-users text-2xl text-indigo-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Participant</div>
                        <div class="text-3xl text-green-700 pl-4">{{ $usercount }}</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                        <i class="fas fa-user text-2xl text-green-700"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Author</div>
                        <div class="text-3xl text-amber-500 pl-4">{{ $authorcount }}</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                        <i class="fas fa-user-tie text-2xl text-amber-500"></i>
                    </div>
                </div>
                <div
                    class="border-l-4 border-rose-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                    <div class="p-2 flex flex-col font-semibold ">
                        <div class="text-base text-gray-800">Admin</div>
                        <div class="text-3xl text-rose-500 pl-4">{{ $admincount }}</div>
                    </div>
                    <div class="rounded-full justify-center flex items-center bg-rose-200 h-10 w-10 m-4">
                        <i class="fas fa-user-secret text-2xl text-rose-500"></i>
                    </div>
                </div>
            </div>

            {{-- tabel --}}
            <div class="container mx-auto p-4">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white bg-indigo-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">Full Name</th>
                                <th scope="col" class="px-6 py-3">Email Address</th>
                                <th scope="col" class="px-6 py-3">Phone Number</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh Baris Tabel --}}
                            @foreach ($users as $user)
                                <tr class="bg-white border-t hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($user->image)
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                        class="bg-purple-600 object-cover text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                    </img>
                                                @else
                                                    <div
                                                        class="bg-purple-600 text-white rounded-full h-10 w-10 flex items-center justify-center text-lg font-semibold">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-gray-900">
                                        @if ($user->no_telp)
                                            {{ $user->no_telp }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button id="show"
                                                class="w-8 h-8 rounded-sm bg-indigo-400 hover:bg-indigo-500 text-white flex items-center justify-center"
                                                aria-label="show">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="users/{{ $user->name }}/edit"
                                                class="w-8 h-8 rounded-sm bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center"
                                                aria-label="edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="users/{{ $user->name }}" method="post">
                                                @method('delete')
                                                @csrf

                                                <button
                                                    onclick="return confirm('anda yakin ingin menghapus {{ $user->name }}')"">
                                                    <div
                                                        class="bg-red-500 p-1 rounded-sm w-8 h-8 flex items-center justify-center group hover:bg-white hover:border-2 hover:border-red-500">
                                                        <span
                                                            class="fa-solid fa-trash cursor-pointer text-white group-hover:text-red-500">
                                                        </span>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            {{-- Akhir Contoh Baris Tabel (Ulangi sesuai kebutuhan) --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 mb-10">
                {{ $users->appends(request()->all())->links() }}
            </div>
            {{-- modal start --}}
            @foreach ($users as $user)
                <div class="">
                    <div id="modal"
                        class="modal ml-54 hidden opacity-0 fixed inset-0 bg-black/50 backdrop-blur-xs transition-all duration-500 ease-in-out flex items-center justify-center z-50 p-25">

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
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="email"
                                            class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="handphone"
                                            class="block text-gray-700 text-sm font-bold mb-2">Handphone</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->no_telp }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="role"
                                            class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                        <div
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            {{ $user->role }}
                                        </div>
                                    </div>
                                </div>
                                <div class="  w-1/3 flex justify-center items-start">
                                    <div class="relative ">
                                        <div
                                            class="rounded-full size-62 bg-gray-300 flex items-center justify-center overflow-hidden">
                                            {{-- Placeholder untuk foto profil --}}
                                            @if ($user->image)
                                                <img src=" {{ asset('storage/' . $user->image) }}" alt=""
                                                    class="w-full object-cover rounded-full size-62 bg-gray-300 flex items-center justify-center">
                                            @else
                                                <svg class="w-20 h-20 text-gray-500" fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @endif

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
                                @if (isset($user->course_type))
                                    <h2 class="block text-gray-700 text-sm font-bold mb-2">
                                        @if ($user->course_type === 'enrolled')
                                            Courses Enrolled
                                        @elseif($user->course_type === 'created')
                                            Courses Created
                                        @endif
                                    </h2>

                                    <div
                                        class="bg-indigo-100 p-2 rounded-lg border-2 border-indigo-300 overflow-y-auto h-50 course-created-scrollable">
                                        @if ($user->course_type === 'enrolled' && isset($user->enrolled_courses) && $user->enrolled_courses->count() > 0)
                                            <ul class="space-y-2">
                                                @foreach ($user->enrolled_courses->sortBy('title') as $enrolledCourse)
                                                    <li
                                                        class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                                        <div class="flex items-center max-w-200 overflow-hidden">
                                                            <div
                                                                class="size-4 rounded-md bg-yellow-300 mr-2 flex-shrink-0">
                                                            </div>
                                                            <span class="truncate min-w-0"
                                                                title="{{ $enrolledCourse->title }}">
                                                                {{ $enrolledCourse->title }}
                                                            </span>
                                                        </div>
                                                        <span class="text-sm text-gray-600">Enrolled</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($user->course_type === 'created' && isset($user->created_courses) && $user->created_courses->count() > 0)
                                            <ul class="space-y-2">
                                                @foreach ($user->created_courses->sortBy('title') as $createdCourse)
                                                    <li
                                                        class="bg-gray-100 rounded-md p-3 flex items-center justify-between shadow-sm">
                                                        <div class="flex items-center max-w-200 overflow-hidden">
                                                            <div
                                                                class="size-4 rounded-md bg-green-300 mr-2 flex-shrink-0">
                                                            </div>
                                                            <span class="truncate min-w-0"
                                                                title="{{ $createdCourse->title }}">
                                                                {{ $createdCourse->title }}
                                                            </span>
                                                        </div>
                                                        <span class="text-sm text-gray-600">Created</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-center text-gray-500 py-4">
                                                @if ($user->course_type === 'enrolled')
                                                    <p>No courses enrolled yet</p>
                                                @elseif($user->course_type === 'created')
                                                    <p>No courses created yet</p>
                                                @endif
                                                <p class="text-xs">User ID: {{ $user->id }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



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
