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
        <div class="h-screen flex sticky top-0 left-0">
            <aside class="bg-gradient-to-b from-sky-600 to-indigo-900 w-54 flex flex-col space-y-1">
                <div class="text-white text-3xl mt-4 pl-6 font-bold">R. DOSEN</div>
                <a href="" class="m-6 mr-2 p-2 rounded-lg border-l-8 border-white bg-white/20 shadow-lg">
                    <i class="fas fa-gauge text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">Dashboard</span></a>
                <div class="text-xs text-white pl-8 border-t-1 border-white/50">Area Admin</div>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-list text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">Content</span></a>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-book-open-reader  text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">Course</span></a>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-users-gear text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">User</span></a>
                <div class="text-xs text-white pl-8 mt-4 border-t-1 border-white/50">Area Saya</div>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-sheet-plastic text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">My Content</span></a>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-book text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">My Course</span></a>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-user-gear text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">My Participant</span></a>
                <a href="" class="ml-6 p-2 rounded-lg border-l-8 border-white/30">
                    <i class="fas fa-user text-white pl-1"></i>
                    <span class="text-white pl-1 font-semibold text-20">My Profile</span></a>
            </aside>
            
            <div class="flex-grow flex flex-col">
                <header class="bg-white shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-800">My Profile</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                            </button>
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-semibold">
                                    A </div>
                                <span class="text-gray-700">User</span>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-grow p-6 bg-gray-100">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <p>Ini adalah area konten untuk My Profile.</p>
                        <div class="h-64 mt-4 bg-gray-200 rounded flex items-center justify-center">
                            Konten Profil Pengguna
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>

    </html>