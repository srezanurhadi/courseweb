<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login R. Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-custom-gradient {
            background-image: linear-gradient(135deg, #1E40AF, #6E11B0);
        }

        .illustration-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .book-animation {
            animation: bookFloat 4s ease-in-out infinite;
        }

        @keyframes bookFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(2deg);
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="relative min-h-screen w-full flex">
        <div class="absolute inset-0 flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 h-1/2 md:h-full bg-custom-gradient p-6 sm:p-8 flex-none"></div>
            <div class="w-full md:w-1/2 h-1/2 md:h-full bg-white flex-none"></div>
        </div>

        <div class="absolute inset-0 flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 h-1/2 md:h-full bg-custom-gradient p-6 sm:p-8 flex-none">
                <h1 class="text-white text-3xl sm:text-4xl font-bold">R. DOSEN</h1>
            </div>
            <div class="w-full md:w-1/2 h-1/2 md:h-full bg-white flex-none">
            </div>
        </div>

        <div class="relative z-10 w-full flex-grow flex items-center justify-center p-4">
            <div
                class="w-full max-w-3xl lg:max-w-4xl flex flex-col md:flex-row shadow-2xl rounded-[40px] overflow-hidden">

                <div
                    class="w-full md:w-[50%] bg-white p-8 sm:p-10 lg:p-12 flex flex-col justify-center order-2 md:order-1">
                    <div class="w-full max-w-xs sm:max-w-sm mx-auto">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-12 text-center">Login</h2>
                        @if (session('success'))
                            <div class="alert-success text-green-600 mt-1 font-xs" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-8">
                                <label for="email" class="sr-only">Email</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email"
                                        class="w-full pl-4 pr-10 py-3 border border-blue-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 placeholder-gray-400 text-sm"
                                        placeholder="Email" required>
                                    <span
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </span>
                                </div>
                                @error('email')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-8">
                                <label for="password" class="sr-only">Password</label>
                                <div class="relative">
                                    <input type="password" id="password_input" name="password"
                                        class="w-full pl-4 pr-10 py-3 border border-blue-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 placeholder-gray-400 text-sm"
                                        placeholder="Password" required>
                                    <span id="togglePassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600">
                                        <svg id="eye_icon_open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg id="eye_icon_closed" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 hidden">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </span>
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6 text-xs sm:text-sm">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="h-4 w-4 text-gray-300 focus:ring-gray-500 border-gray-300 rounded">
                                    <label for="remember-me" class="ml-2 block font-medium text-gray-400">Remember
                                        me</label>
                                </div>
                                <div>
                                    <a href="#" class="font-medium text-blue-900 hover:text-blue-600">Forgot the
                                        password?</a>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-32 mx-auto flex justify-center py-2 sm:py-1 px-2 border border-transparent rounded-md shadow-sm text-medium font-medium text-blue-900 bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Login
                                </button>
                            </div>
                        </form>
                        <p class="mt-8 text-center text-xs sm:text-sm text-gray-600">
                            Don't have an account yet? <a href="/register"
                                class="font-medium text-blue-900 hover:text-blue-600">Register</a>
                        </p>
                    </div>
                </div>

                <div
                    class="w-full md:w-[50%] bg-custom-gradient p-8 sm:p-8 lg:p-8 flex flex-col justify-center items-center text-white order-1 md:order-2 relative overflow-hidden">
                    <!-- Background Grid Pattern -->
                    <div class="absolute inset-0 opacity-20">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <pattern id="grid" width="30" height="30" patternUnits="userSpaceOnUse">
                                <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="1"
                                    opacity="0.3" />
                            </pattern>
                            <rect width="100%" height="100%" fill="url(#grid)" />
                        </svg>
                    </div>

                    <!-- Main Content -->
                    <div class="w-full max-w-xs sm:max-w-sm text-right relative z-10 ml-auto mr-4">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-2">Hallo,<br>Selamat Datang Kembali<br>di Ruang
                            Dosen !</h2>
                        <p class="text-sm sm:text-base font-sans opacity-90 mb-2">
                            Silakan masuk untuk melanjutkan aktivitas belajar Anda ~
                        </p>
                    </div>

                    <!-- Illustration -->
                    <div class="relative w-full max-w-sm h-64 mt-4">
                        <svg viewBox="0 0 300 250" class="w-full h-full">
                            <!-- Background circles -->
                            <circle cx="220" cy="180" r="40" fill="#10B981" opacity="0.8"
                                class="illustration-float" />
                            <circle cx="80" cy="60" r="25" fill="#F59E0B" opacity="0.7" />

                            <!-- Books stack -->
                            <g class="book-animation">
                                <!-- Book 1 (bottom) -->
                                <rect x="80" y="180" width="60" height="8" rx="2" fill="#EF4444" />
                                <!-- Book 2 -->
                                <rect x="85" y="170" width="55" height="8" rx="2" fill="#3B82F6" />
                                <!-- Book 3 -->
                                <rect x="90" y="160" width="50" height="8" rx="2" fill="#10B981" />
                                <!-- Book 4 (top) -->
                                <rect x="95" y="150" width="45" height="8" rx="2" fill="#F59E0B" />
                            </g>

                            <!-- Person sitting -->
                            <g class="illustration-float">
                                <!-- Body -->
                                <ellipse cx="150" cy="160" rx="20" ry="25"
                                    fill="#EC4899" />

                                <!-- Head -->
                                <circle cx="150" cy="120" r="18" fill="#FDE68A" />

                                <!-- Hair -->
                                <path d="M 132 115 Q 150 100 168 115 Q 168 125 150 130 Q 132 125 132 115"
                                    fill="#7C2D12" />

                                <!-- Arms -->
                                <ellipse cx="170" cy="145" rx="8" ry="20" fill="#FDE68A"
                                    transform="rotate(20 170 145)" />
                                <ellipse cx="130" cy="145" rx="8" ry="20" fill="#FDE68A"
                                    transform="rotate(-20 130 145)" />

                                <!-- Legs -->
                                <ellipse cx="140" cy="185" rx="10" ry="25"
                                    fill="#3B82F6" />
                                <ellipse cx="160" cy="185" rx="10" ry="25"
                                    fill="#3B82F6" />

                                <!-- Laptop -->
                                <rect x="135" y="150" width="30" height="20" rx="2" fill="#374151" />
                                <rect x="137" y="152" width="26" height="16" rx="1" fill="#1F2937" />

                                <!-- Screen glow -->
                                <rect x="138" y="153" width="24" height="14" rx="1" fill="#60A5FA"
                                    opacity="0.3" />
                            </g>

                            <!-- Floating elements -->
                            <g class="illustration-float" style="animation-delay: -1s;">
                                <!-- Star -->
                                <path
                                    d="M 50 100 L 52 106 L 58 106 L 53 110 L 55 116 L 50 112 L 45 116 L 47 110 L 42 106 L 48 106 Z"
                                    fill="#FBBF24" />

                                <!-- Light bulb -->
                                <circle cx="230" cy="80" r="8" fill="#FDE68A" />
                                <rect x="228" y="88" width="4" height="6" fill="#9CA3AF" />
                                <rect x="227" y="94" width="6" height="2" fill="#9CA3AF" />
                            </g>

                            <!-- Mathematical symbols -->
                            <text x="200" y="50" font-family="Arial" font-size="20" fill="white" opacity="0.6"
                                class="illustration-float" style="animation-delay: -2s;">∑</text>
                            <text x="40" y="180" font-family="Arial" font-size="16" fill="white" opacity="0.5"
                                class="illustration-float" style="animation-delay: -0.5s;">π</text>
                            <text x="250" y="140" font-family="Arial" font-size="18" fill="white" opacity="0.4"
                                class="illustration-float" style="animation-delay: -1.5s;">∞</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password_input');
        const eyeIconOpen = document.getElementById('eye_icon_open');
        const eyeIconClosed = document.getElementById('eye_icon_closed');

        if (togglePasswordButton && passwordInput && eyeIconOpen && eyeIconClosed) {
            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIconOpen.classList.toggle('hidden');
                eyeIconClosed.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>
