<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - R. DOSEN</title>
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

        .faq-item {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
            backdrop-filter: blur(10px);
        }

        .faq-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
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

        .text-gradient {
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .category-header {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(99, 102, 241, 0.1) 100%);
            border-left: 4px solid;
            border-image: linear-gradient(135deg, #3D7FBA, #6366F1) 1;
        }

        .support-card {
            background: linear-gradient(135deg, #3D7FBA 0%, #6366F1 100%);
        }

        .register-link {
            color: #3D7FBA;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .register-link:hover {
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
            color: white;
            transform: translateY(-1px);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    {{-- Header Section --}}
    <div class="bg-custom-gradient shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>

        {{-- Floating Background Elements --}}
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating-element"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full floating-element"
            style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full floating-element"
            style="animation-delay: -4s;"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-16">
            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 icon-gradient rounded-full mb-8 shadow-2xl">
                    <i class="fas fa-question-circle text-white text-3xl"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Pusat Bantuan
                </h1>
                <p class="text-2xl text-white/90 max-w-3xl mx-auto mb-4 font-light">
                    Punya pertanyaan? Kami siap membantu.
                </p>
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white/90">
                    <i class="fas fa-headset mr-3"></i>
                    <span class="font-medium">Temukan jawabanmu di bawah ini</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-5xl mx-auto px-6 -mt-12 relative z-10 pb-16">

        {{-- FAQ Title --}}
        <div class="content-card rounded-3xl p-8 md:p-12 mb-12">
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mb-6">
                    <i class="fas fa-question text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gradient mb-4">Pertanyaan Umum (FAQ)</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto rounded-full"></div>
            </div>

            {{-- Account & Registration Section --}}
            <div class="mb-12">
                <div class="category-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-plus text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Akun & Pendaftaran</h3>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-user-check text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Bagaimana cara membuat akun di R.
                                    Dosen?</h4>
                                <p class="text-gray-700 leading-relaxed">Anda dapat membuat akun dengan mengklik tombol
                                    <a href="/register" class="register-link">"Daftar"</a> atau <a href="/register"
                                        class="register-link">"Register"</a>, kemudian isi data yang diperlukan seperti
                                    nama, email, dan password, lalu ikuti petunjuk verifikasi email yang akan dikirimkan
                                    ke inbox Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-key text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Saya lupa kata sandi. Apa yang harus
                                    saya lakukan?</h4>
                                <p class="text-gray-700 leading-relaxed">Pada halaman login, klik link "Lupa Kata
                                    Sandi?". Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan
                                    untuk mengatur ulang kata sandi Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Courses & Learning Section --}}
            <div class="mb-12">
                <div class="category-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Kursus & Pembelajaran</h3>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-plus-circle text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Bagaimana cara mendaftar (enroll)
                                    sebuah kursus?</h4>
                                <p class="text-gray-700 leading-relaxed">Kunjungi halaman detail kursus yang Anda
                                    inginkan, lalu klik tombol "Enroll Sekarang". Ikuti prosesnya hingga selesai, dan
                                    kursus akan otomatis muncul di halaman "My Course" Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-infinity text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Apakah saya mendapatkan akses selamanya
                                    ke kursus yang sudah dibeli?</h4>
                                <p class="text-gray-700 leading-relaxed">Ya! Sekali Anda terdaftar di sebuah kursus,
                                    Anda memiliki akses seumur hidup ke semua materi pembelajarannya, termasuk pembaruan
                                    di masa depan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-certificate text-yellow-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Apakah saya akan mendapatkan sertifikat
                                    setelah menyelesaikan kursus?</h4>
                                <p class="text-gray-700 leading-relaxed">Tentu saja. Setelah menyelesaikan semua materi
                                    kursus, Anda akan mendapatkan sertifikat penyelesaian yang dapat diunduh dan
                                    dibagikan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Technical & Payment Section --}}
            <div class="mb-12">
                <div class="category-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-cog text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Teknis & Pembayaran</h3>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-credit-card text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Metode pembayaran apa saja yang
                                    diterima?</h4>
                                <p class="text-gray-700 leading-relaxed">Saat ini kami menerima pembayaran melalui
                                    transfer bank dan e-wallet (GoPay, OVO, DANA). Kami terus berupaya untuk menambahkan
                                    metode pembayaran lainnya.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-play-circle text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-3">Video pembelajaran tidak dapat diputar,
                                    apa solusinya?</h4>
                                <p class="text-gray-700 leading-relaxed">Pastikan koneksi internet Anda stabil. Coba
                                    segarkan (refresh) halaman. Jika masalah berlanjut, coba gunakan browser lain atau
                                    bersihkan cache browser Anda. Jika masih belum berhasil, hubungi tim support kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Support Section --}}
        <div class="content-card rounded-3xl overflow-hidden mb-12">
            <div class="support-card p-12 text-center text-white relative">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-8">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4">Masih Butuh Bantuan?</h2>
                    <p class="text-xl text-white/90 mb-2">Tim Customer Support kami siap membantu Anda</p>
                    <p class="text-white/80 mb-8">Senin - Jumat, pukul 08:00 - 17:00 WIB</p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="mailto:support@rdosen.com"
                            class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                            <i class="fas fa-envelope mr-3"></i>
                            Hubungi via Email
                        </a>

                        <div class="flex items-center justify-center space-x-6 text-white/80">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                <span class="text-sm">Response dalam 24 jam</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Section --}}
        <div class="text-center">
            <a href="javascript:history.back()"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-arrow-left mr-3"></i>
                Kembali ke Halaman Sebelumnya
            </a>
        </div>
    </div>

    {{-- Sebaiknya sertakan footer di sini jika ada --}}

</body>

</html>
