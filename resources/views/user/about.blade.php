<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - R. Dosen</title>
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
        .feature-card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            backdrop-filter: blur(10px);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Header Section --}}
    <div class="bg-custom-gradient shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
        
        {{-- Floating Background Elements --}}
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating-element"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full floating-element" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full floating-element" style="animation-delay: -4s;"></div>
        
        <div class="relative max-w-6xl mx-auto px-6 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 icon-gradient rounded-full mb-8 shadow-2xl">
                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Tentang R. Dosen
                </h1>
                <p class="text-2xl text-white/90 max-w-3xl mx-auto mb-4 font-light">
                    Membuka Pintu Potensi Melalui Pendidikan Digital
                </p>
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white/90">
                    <i class="fas fa-rocket mr-3"></i>
                    <span class="font-medium">Transformasi Pembelajaran Digital</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-6xl mx-auto px-6 -mt-12 relative z-10 pb-16">
        
        {{-- Mission Section --}}
        <div class="content-card rounded-3xl p-8 md:p-12 mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-white text-xl"></i>
                        </div>
                        <h2 class="text-4xl font-bold text-gradient">Misi Kami</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-100">
                            <p class="text-gray-700 leading-relaxed text-lg">
                                Di <span class="font-bold text-indigo-600">R. Dosen</span>, kami percaya bahwa pendidikan berkualitas adalah hak setiap individu untuk meraih mimpinya. Misi kami adalah menyediakan platform pembelajaran yang mudah diakses, relevan dengan kebutuhan industri, dan diajarkan langsung oleh para ahli di bidangnya.
                            </p>
                        </div>
                        
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-100">
                            <p class="text-gray-700 leading-relaxed text-lg">
                                Nama <span class="font-bold text-purple-600">"R. Dosen"</span> merepresentasikan "Ruang Dosen", sebuah tempat di mana para pembelajar dapat terhubung dengan para ahli—para 'dosen' modern—untuk mendapatkan wawasan mendalam dan bimbingan yang nyata.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-600 rounded-3xl transform rotate-6 opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070" 
                             alt="Tim R. Dosen sedang berdiskusi" 
                             class="relative rounded-3xl shadow-2xl w-full max-w-md object-cover h-80">
                    </div>
                </div>
            </div>
        </div>

        {{-- Why Choose Us Section --}}
        <div class="content-card rounded-3xl p-8 md:p-12 mb-12">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl mb-6">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gradient mb-4">Mengapa Memilih R. Dosen?</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="feature-card p-8 rounded-2xl shadow-lg border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-800">Pengajar Ahli</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Belajar langsung dari praktisi dan akademisi berpengalaman yang telah terbukti di industrinya.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-2xl shadow-lg border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-clipboard-list text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-800">Kurikulum Relevan</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Materi disusun secara cermat untuk memenuhi tuntutan pasar kerja saat ini dan di masa depan.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-2xl shadow-lg border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-800">Belajar Fleksibel</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Akses materi kapan saja dan di mana saja. Atur ritme belajarmu sendiri sesuai kesibukanmu.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-2xl shadow-lg border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-800">Komunitas Solid</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Bergabunglah dengan komunitas pembelajar, berdiskusi, dan bangun jaringan profesionalmu.
                    </p>
                </div>
            </div>
        </div>

        {{-- Call to Action Section --}}
        <div class="content-card rounded-3xl p-8 md:p-12 mb-12">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-pink-500 to-rose-600 rounded-full mb-8">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gradient mb-6">Mari Wujudkan Mimpimu</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto mb-8 leading-relaxed">
                    Apapun tujuanmu—meningkatkan karier, memulai bisnis, atau sekadar mempelajari hal baru—R. Dosen hadir untuk mendukung setiap langkah perjalananmu.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('user.course.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                        <i class="fas fa-book-open mr-3"></i>
                        Lihat Semua Kursus
                    </a>
                    
                    <div class="flex items-center space-x-6 text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2 text-blue-500"></i>
                            <span class="font-medium">1000+ Siswa</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-award mr-2 text-green-500"></i>
                            <span class="font-medium">50+ Kursus</span>
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