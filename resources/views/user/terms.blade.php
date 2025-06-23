<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat dan Ketentuan - R. Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-custom-gradient {
            background: linear-gradient(135deg, #3D7FBA 0%, #1E40AF 50%, #6366F1 100%);
        }
        
        .content-card {
            background: white;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .icon-gradient {
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
        }
        
        .section-item {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            backdrop-filter: blur(10px);
        }
        
        .section-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .section-header {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(99, 102, 241, 0.1) 100%);
            border-left: 4px solid;
            border-image: linear-gradient(135deg, #3D7FBA, #6366F1) 1;
        }
        
        .contact-card {
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
        
        .list-custom li {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 0.75rem;
        }
        
        .list-custom li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            background: linear-gradient(135deg, #3D7FBA, #6366F1);
            border-radius: 50%;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <!-- Header Section -->
    <div class="bg-custom-gradient shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
        
        <!-- Floating Background Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating-element"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full floating-element" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full floating-element" style="animation-delay: -4s;"></div>
        
        <div class="relative max-w-6xl mx-auto px-6 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 icon-gradient rounded-full mb-8 shadow-2xl">
                    <i class="fas fa-file-contract text-white text-3xl"></i>
                </div>
                <h2 class="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Syarat dan Ketentuan
                </h2>
                <p class="text-2xl text-white/90 max-w-3xl mx-auto mb-4 font-light">
                    Panduan lengkap penggunaan platform R. Dosen
                </p>
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white/90">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span class="font-medium">Terakhir diperbarui: {{ date('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-6 -mt-12 relative z-10 pb-16">
        
        <!-- Content Card -->
        <div class="content-card rounded-3xl p-8 md:p-12 mb-12">
            
            <!-- Section 1: Penerimaan Syarat -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-handshake text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">1. Penerimaan Syarat</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                Dengan mendaftar dan menggunakan platform R. Dosen, Anda menyetujui untuk terikat dengan syarat dan ketentuan ini. 
                                Jika Anda tidak menyetujui syarat ini, mohon untuk tidak menggunakan layanan kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Definisi Layanan -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">2. Definisi Layanan</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-info-circle text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                R. Dosen adalah platform pembelajaran online yang menyediakan akses ke berbagai materi pembelajaran, 
                                kursus, dan sumber daya pendidikan untuk dosen dan akademisi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Akun Pengguna -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-cog text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">3. Akun Pengguna</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-list text-purple-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-700 leading-relaxed mb-4">Sebagai pengguna platform R. Dosen, Anda bertanggung jawab untuk:</p>
                            <ul class="list-custom text-gray-700 space-y-2">
                                <li>Menjaga kerahasiaan akun dan password Anda</li>
                                <li>Memberikan informasi yang akurat dan lengkap saat mendaftar</li>
                                <li>Bertanggung jawab atas semua aktivitas yang terjadi di akun Anda</li>
                                <li>Segera melaporkan kepada kami jika ada penggunaan tidak sah terhadap akun Anda</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Penggunaan Platform -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">4. Penggunaan Platform</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-ban text-red-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-700 leading-relaxed mb-4">Anda setuju untuk tidak:</p>
                            <ul class="list-custom text-gray-700 space-y-2">
                                <li>Menggunakan platform untuk tujuan yang melanggar hukum</li>
                                <li>Mengganggu atau merusak keamanan platform</li>
                                <li>Menyebarkan konten yang tidak pantas atau melanggar hak cipta</li>
                                <li>Mencoba mengakses akun pengguna lain tanpa izin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Konten dan Hak Kekayaan Intelektual -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-copyright text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">5. Konten dan Hak Kekayaan Intelektual</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-shield-alt text-yellow-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                Semua konten yang tersedia di platform R. Dosen, termasuk teks, gambar, video, dan materi pembelajaran lainnya, 
                                dilindungi oleh hak cipta dan hak kekayaan intelektual lainnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 6: Privasi -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-shield text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">6. Privasi</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-lock text-indigo-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                Kami menghormati privasi Anda dan berkomitmen untuk melindungi data pribadi Anda sesuai dengan 
                                kebijakan privasi kami yang dapat diakses secara terpisah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 7: Pembatasan Tanggung Jawab -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-balance-scale text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">7. Pembatasan Tanggung Jawab</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-gavel text-gray-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                R. Dosen tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial 
                                yang mungkin timbul dari penggunaan platform ini.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 8: Perubahan Syarat -->
            <div class="mb-12">
                <div class="section-header p-6 rounded-2xl mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-edit text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">8. Perubahan Syarat</h3>
                    </div>
                </div>
                
                <div class="section-item p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-sync-alt text-teal-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-gray-700 leading-relaxed">
                                Kami berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku efektif 
                                setelah dipublikasikan di platform ini.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="content-card rounded-3xl overflow-hidden mb-12">
            <div class="contact-card p-12 text-center text-white relative">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-8">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4">9. Kontak</h2>
                    <p class="text-xl text-white/90 mb-2">Ada pertanyaan mengenai syarat dan ketentuan ini?</p>
                    <p class="text-white/80 mb-8">Tim kami siap membantu Anda</p>
                    
                    <div class="grid md:grid-cols-2 gap-6 max-w-lg mx-auto">
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6">
                            <i class="fas fa-envelope text-2xl mb-3"></i>
                            <h4 class="font-bold mb-2">Email</h4>
                            <p class="text-white/90">support@rdosen.com</p>
                        </div>
                        
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6">
                            <i class="fas fa-phone text-2xl mb-3"></i>
                            <h4 class="font-bold mb-2">Telepon</h4>
                            <p class="text-white/90">+62 123-4567-8910</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Section -->
        <div class="text-center">
            <a href="javascript:history.back()" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 mr-4">
                <i class="fas fa-arrow-left mr-3"></i>
                Kembali ke Halaman Sebelumnya
            </a>
        </div>
    </div>

</body>

</html>