<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - R. DOSEN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-custom-gradient {
            background: linear-gradient(135deg, #3D7FBA 0%, #1E40AF 50%, #6366F1 100%);
        }

        .section-divider {
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            height: 1px;
        }

        .content-card {
            background: white;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .icon-gradient {
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-custom-gradient shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>

        <!-- Floating Background Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating-element"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full floating-element"
            style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full floating-element"
            style="animation-delay: -4s;"></div>
        <div class="absolute top-20 right-1/3 w-14 h-14 bg-white/8 rounded-full floating-element"
            style="animation-delay: -3s;"></div>
        <div class="absolute bottom-32 right-10 w-18 h-18 bg-white/6 rounded-full floating-element"
            style="animation-delay: -1s;"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-12">
            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 icon-gradient rounded-full mb-6 shadow-lg">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    Kebijakan Privasi
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto mb-2">
                    Komitmen kami untuk melindungi privasi dan keamanan data Anda
                </p>
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-white/90">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Terakhir diperbarui: 21 Juni 2025</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-6 -mt-8 relative z-10 pb-12">
        <div class="content-card rounded-2xl p-8 md:p-12 mb-8">
            <!-- Introduction -->
            <div class="mb-12 text-center">
                <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
                    Selamat datang di <span class="font-semibold text-indigo-600">R. Dosen</span>.
                    Kami menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi Anda.
                    Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan,
                    dan menjaga informasi Anda saat Anda mengunjungi dan menggunakan platform kami.
                </p>
            </div>

            <!-- Content Sections -->
            <div class="space-y-10">
                <!-- Section 1 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                            <i class="fas fa-database text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                                1. Informasi yang Kami Kumpulkan
                            </h2>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                Kami dapat mengumpulkan informasi tentang Anda dalam berbagai cara, termasuk:
                            </p>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mb-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Data Pribadi</h4>
                                    <p class="text-sm text-gray-600">Nama, alamat email, dan nomor telepon yang Anda
                                        berikan saat mendaftar atau berpartisipasi dalam aktivitas platform.</p>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mb-3">
                                        <i class="fas fa-chart-line text-white text-sm"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Data Penggunaan</h4>
                                    <p class="text-sm text-gray-600">Alamat IP, jenis browser, waktu akses, dan halaman
                                        yang Anda lihat dikumpulkan secara otomatis oleh server kami.</p>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-purple-50 to-violet-50 p-6 rounded-xl border border-purple-100">
                                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mb-3">
                                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Data Pembelajaran</h4>
                                    <p class="text-sm text-gray-600">Kemajuan kursus, kuis yang diselesaikan, dan
                                        sertifikat yang diperoleh untuk melacak perkembangan belajar Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 2 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                            <i class="fas fa-cogs text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors">
                                2. Bagaimana Kami Menggunakan Informasi Anda
                            </h2>
                            <p class="text-gray-700 mb-6 leading-relaxed">
                                Memiliki informasi yang akurat tentang Anda memungkinkan kami untuk memberikan
                                pengalaman yang lancar dan efisien.
                                Secara khusus, kami dapat menggunakan informasi yang dikumpulkan tentang Anda untuk:
                            </p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Membuat dan mengelola akun Anda</span>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Memproses pendaftaran kursus online</span>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Mengirimkan email administratif</span>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Meningkatkan efisiensi platform</span>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Memantau dan menganalisis penggunaan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 3 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                            <i class="fas fa-share-alt text-orange-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors">
                                3. Pembagian Informasi Anda
                            </h2>
                            <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-4">
                                <div class="flex items-center mb-3">
                                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                                    <h4 class="font-semibold text-red-800">Komitmen Privasi</h4>
                                </div>
                                <p class="text-red-700">
                                    Kami tidak akan membagikan, menjual, menyewakan, atau memperdagangkan informasi
                                    pribadi Anda dengan pihak ketiga untuk tujuan promosi mereka.
                                </p>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Kami dapat membagikan informasi Anda dengan pihak ketiga yang melakukan layanan untuk
                                kami atau atas nama kami,
                                termasuk pemrosesan pembayaran dan analisis data. Kami juga dapat mengungkapkan
                                informasi Anda jika diwajibkan oleh hukum.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 4 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                            <i class="fas fa-lock text-red-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-600 transition-colors">
                                4. Keamanan Data Anda
                            </h2>
                            <p class="text-gray-700 leading-relaxed">
                                Kami menggunakan langkah-langkah keamanan administratif, teknis, dan fisik untuk
                                membantu melindungi informasi pribadi Anda.
                                Meskipun kami telah mengambil langkah-langkah yang wajar untuk mengamankan informasi
                                pribadi yang Anda berikan kepada kami,
                                perlu diketahui bahwa tidak ada sistem keamanan yang sempurna atau tidak dapat ditembus.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 5 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                            <i class="fas fa-user-check text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-purple-600 transition-colors">
                                5. Hak Anda
                            </h2>
                            <p class="text-gray-700 leading-relaxed">
                                Anda berhak untuk meninjau, mengubah, atau menghentikan akun Anda kapan saja.
                                Anda dapat melakukannya dengan masuk ke pengaturan profil akun Anda dan memperbaruinya.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 6 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                            <i class="fas fa-sync-alt text-indigo-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-indigo-600 transition-colors">
                                6. Perubahan pada Kebijakan Ini
                            </h2>
                            <p class="text-gray-700 leading-relaxed">
                                Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Versi yang diperbarui
                                akan ditandai dengan tanggal
                                "Terakhir diperbarui" yang diperbarui dan akan berlaku segera setelah dapat diakses.
                                Kami menganjurkan Anda untuk
                                meninjau kebijakan privasi ini secara berkala agar tetap mengetahui bagaimana kami
                                melindungi informasi Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section 7 -->
                <div class="group">
                    <div class="flex items-start space-x-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                            <i class="fas fa-envelope text-teal-600"></i>
                        </div>
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-teal-600 transition-colors">
                                7. Hubungi Kami
                            </h2>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                Jika Anda memiliki pertanyaan atau komentar tentang Kebijakan Privasi ini, silakan
                                hubungi kami di:
                            </p>
                            <div
                                class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-headset text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Customer Support</h4>
                                        <a href="mailto:support@rdosen.com"
                                            class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                            support@rdosen.com
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="text-center">
            <a href="javascript:history.back()"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-arrow-left mr-3"></i>
                Kembali ke Halaman Sebelumnya
            </a>
        </div>
    </div>
</body>

</html>
