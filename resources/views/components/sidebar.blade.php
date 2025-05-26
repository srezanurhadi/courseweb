<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite('resources/css/app.css')


</head>

<body>

    <div class="flex h-screen">
        <aside class="bg-indigo-700 text-white w-64 flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-indigo-600">
                R. OOSEN
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h12A2.25 2.25 0 0020.25 14.25V3m-16.5 0h16.5M3.75 3v1.5A2.25 2.25 0 016 6.75h12A2.25 2.25 0 0120.25 4.5V3m-16.5 0h16.5M3.75 6.75v7.5h16.5v-7.5H3.75z" />
                    </svg>
                    Dashboard
                </a>
                <div class="px-3 text-sm text-indigo-300 uppercase mt-4 mb-2">Area Saya</div>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    My Course
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    My Content
                </a>
                <a href="#"
                    class="flex items-center px-4 py-3 rounded-lg bg-indigo-800 text-white transition-colors"> <svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    My Participant
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    My Profile
                </a>
            </nav>

            <div class="p-4 border-t border-indigo-600">
                <button
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    Logout
                </button>
                <p class="text-center text-xs text-indigo-300 mt-4">
                    ©2025
                </p>
            </div>
        </aside>

        <main class="flex-1 p-10">
            <h1 class="text-2xl font-bold">Konten Utama</h1>
        </main>
    </div>
</body>
</body>

</html>
