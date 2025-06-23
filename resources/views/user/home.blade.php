<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Modern - R. Dosen</title>
    <x-headcomponent></x-headcomponent>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* === PENYEMPURNAAN === */

        /* 1. Transisi Halus untuk Semua Elemen Interaktif */
        .enhanced-transition {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* 2. Header dengan Gradien Lembut */
        .hero-header-gradient {
            background: linear-gradient(145deg, #e0e7ff 0%, #c7d2fe 100%);
        }

        /* 3. Kartu yang Lebih Interaktif */
        .enhanced-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        /* 4. Judul Section yang Lebih Elegan */
        .section-title {
            position: relative;
            padding-bottom: 10px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 4px;
            background-color: #6366f1; /* Warna indigo */
            border-radius: 2px;
        }

        /* 5. Tombol Navigasi Slider yang Lebih Baik */
        .swiper-nav-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .swiper-nav-button:hover {
            background-color: white;
            transform: scale(1.1);
        }
        .swiper-nav-button i {
            color: #4f46e5; /* Warna indigo-600 */
        }
        .swiper-pagination-bullet-active {
            background-color: #4f46e5 !important;
        }

        /* 6. Animasi Fade-in-up Saat Scroll */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .reveal {
            opacity: 0;
        }
        .reveal.visible {
            animation: fadeInUp 0.8s ease-out forwards;
        }


        /* === GAYA ASLI ANDA YANG DIPERTAHANKAN & DIPERBAIKI === */
        .swiper-button-next::after,
        .swiper-button-prev::after,
        .investorswiper-button-next::after,
        .investorswiper-button-prev::after {
            content: '';
        }

        .mySwiper { height: 100%; }
        .swiper-slide img { object-fit: cover; width: 100%; height: 100%; }

        .investorSwiper { height: 120px; width: 100%; }
        .investorSwiper .swiper-slide { width: auto !important; display: flex; justify-content: center; align-items: center; }
        .investorSwiper .swiper-slide img { object-fit: contain; max-width: 100%; width: 400px; padding: 10px; box-sizing: border-box; }
        .swiper-wrapper { align-items: center; }

        .chart-container {
            width: 300px;
            background: #6366f1; /* Warna ungu/indigo solid SESUAI PERMINTAAN */
            border-radius: 20px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .chart-title { font-weight: 600; font-size: 18px; color: white; }
    </style>
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="flex-1 bg-slate-50">
            {{-- - Navbar - --}}
            <nav class="bg-white shadow-md z-50 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">Home</h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button class="enhanced-transition hover:scale-110">
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-indigo-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3 py-2 rounded-full enhanced-transition hover:bg-slate-100 cursor-pointer">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xl font-semibold leading-none text-gray-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    @endif
                                </span>
                                <span class="text-xl font-semibold text-gray-700">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- - Content Area - --}}
            <main>
                <header class="h-[400px] rounded-b-3xl mb-4 flex justify-center items-center relative overflow-hidden hero-header-gradient">
                    <div class="wrapper max-w-[1152px] relative w-full mx-4 h-[350px]">
                        <div class="swiper mySwiper w-full h-full">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide !w-[700px] flex-shrink-0"><img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=500&fit=crop&crop=faces" alt="Office workspace" class="rounded-lg shadow-md"></div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0"><img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&h=500&fit=crop&crop=center" alt="Modern building" class="rounded-lg shadow-md"></div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0"><img src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=800&h=500&fit=crop&crop=center" alt="Team meeting" class="rounded-lg shadow-md"></div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop&crop=center" alt="Business discussion" class="rounded-lg shadow-md"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper-button-prev absolute left-4 top-1/2 transform -translate-y-1/2 swiper-nav-button enhanced-transition"><i class="fa-solid fa-chevron-left text-xl"></i></div>
                        <div class="swiper-button-next absolute right-4 top-1/2 transform -translate-y-1/2 swiper-nav-button enhanced-transition"><i class="fa-solid fa-chevron-right text-xl"></i></div>
                    </div>
                </header>

                <div class="mb-12 reveal">
                    <h1 class="text-center font-bold text-2xl mb-10 section-title">My Progress</h1>
                    <div class="max-w-6xl mx-auto px-2">
                        <div class="flex flex-wrap justify-center gap-8">
                            <div class="chart-container enhanced-card enhanced-transition"><div id="finishedChart" class="w-full"></div><p class="chart-title">Finished Course</p></div>
                            <div class="chart-container enhanced-card enhanced-transition"><div id="ongoingChart" class="w-full"></div><p class="chart-title">Ongoing Course</p></div>
                            <div class="chart-container enhanced-card enhanced-transition"><div id="overallChart" class="w-full"></div><p class="chart-title">Progress Overall</p></div>
                        </div>
                    </div>
                </div>

                <div class="mb-12 reveal">
                    <h1 class="text-center font-bold text-2xl mb-10 section-title">Achieve Your Dreams with R. DOSEN</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mx-auto max-w-7xl px-4">
                        <div class="flex flex-col items-center text-center bg-white p-6 border border-gray-200 rounded-lg enhanced-card enhanced-transition"><img src="https://cdn-icons-png.flaticon.com/512/7051/7051237.png" alt="Icon" class="w-24 h-24 mb-4"><p class="font-semibold leading-tight text-lg text-indigo-800 mt-auto">Over 1.5 Million+ Members<br />Learning Together</p></div>
                        <div class="flex flex-col items-center text-center bg-white p-6 border border-gray-200 rounded-lg enhanced-card enhanced-transition"><img src="https://cdn-icons-png.flaticon.com/512/639/639343.png" alt="Icon" class="w-24 h-24 mb-4"><p class="font-semibold leading-tight text-lg text-indigo-800 mt-auto">Thousands of Alumni Work in National & Global Companies</p></div>
                        <div class="flex flex-col items-center text-center bg-white p-6 border border-gray-200 rounded-lg enhanced-card enhanced-transition"><img src="https://cdn-icons-png.flaticon.com/512/3330/3330423.png" alt="Icon" class="w-24 h-24 mb-4"><p class="font-semibold leading-tight text-lg text-indigo-800 mt-auto">Certified</p></div>
                        <div class="flex flex-col items-center text-center bg-white p-6 border border-gray-200 rounded-lg enhanced-card enhanced-transition"><img src="https://cdn-icons-png.flaticon.com/512/12836/12836911.png" alt="Icon" class="w-24 h-24 mb-4"><p class="font-semibold leading-tight text-lg text-indigo-800 mt-auto">50k++ New Members Learning per Month</p></div>
                    </div>
                </div>

                <div class="mb-12 bg-white py-12 reveal">
                    <h1 class="text-center font-bold text-2xl mb-10 section-title">Investors and Affiliations</h1>
                    <div class="max-w-6xl mx-auto relative overflow-hidden px-2">
                        <div class="swiper investorSwiper h-full">
                            <div class="swiper-wrapper w-full h-[150px]">
                                <div class="swiper-slide"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjWOHn77fEZlM042r9lFIpXf9dVP8DLik56Q&s" alt="Investor Logo 1" class="rounded-lg border border-gray-200"></div>
                                <div class="swiper-slide"><img src="https://dqlab.id/files/dqlab/file/data-web-1/data-user-2/20241016103945.png" alt="Investor Logo 2" class="rounded-lg border border-gray-200"></div>
                                <div class="swiper-slide"><img src="https://manage.aseanbacindonesia.id/uploads/East_Ventures_logo_color_eccaf8ac56.png" alt="Investor Logo 3" class="rounded-lg border border-gray-200"></div>
                                <div class="swiper-slide"><img src="https://startupstudio.id/wp-content/uploads/2021/04/Vertical-Lockup-on-White-2-1024x433.png" alt="Investor Logo 4" class="rounded-lg border border-gray-200"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8 reveal">
                    <h1 class="text-center font-bold text-2xl mb-10 section-title">Frequently Asked Questions (FAQ)</h1>
                    <div class="max-w-3xl mx-auto space-y-4 px-4">
                        
                        {{-- FAQ 1 --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm enhanced-transition hover:border-indigo-300">
                            <button class="flex justify-between items-center w-full text-left px-5 py-4 cursor-pointer" onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-800">Bagaimana cara menyampaikan keluhan atau pengaduan?</h4>
                                <i class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-300 transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-4 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">Anda dapat menyampaikan keluhan atau pengaduan melalui halaman 'Hubungi Kami' yang menyediakan formulir khusus, atau dengan mengirimkan email langsung ke support@rdosen.com.</p>
                            </div>
                        </div>

                        {{-- FAQ 2 --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm enhanced-transition hover:border-indigo-300">
                            <button class="flex justify-between items-center w-full text-left px-5 py-4 cursor-pointer" onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-800">Apakah materi bisa diakses selamanya?</h4>
                                <i class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-300 transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-4 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">Tentu! Setelah Anda membeli atau mendaftar di sebuah kelas, Anda akan memiliki akses seumur hidup ke seluruh materi, termasuk pembaruan di masa mendatang.</p>
                            </div>
                        </div>
                        
                        {{-- FAQ 3 (TAMBAHAN) --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm enhanced-transition hover:border-indigo-300">
                            <button class="flex justify-between items-center w-full text-left px-5 py-4 cursor-pointer" onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-800">Metode pembayaran apa saja yang diterima?</h4>
                                <i class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-300 transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-4 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">Kami menerima berbagai metode pembayaran, termasuk transfer bank, kartu kredit (Visa, MasterCard), dan dompet digital (GoPay, OVO, Dana) untuk kemudahan Anda.</p>
                            </div>
                        </div>

                        {{-- FAQ 4 (TAMBAHAN) --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm enhanced-transition hover:border-indigo-300">
                            <button class="flex justify-between items-center w-full text-left px-5 py-4 cursor-pointer" onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-800">Apa yang harus saya lakukan jika video tidak bisa diputar?</h4>
                                <i class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-300 transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-4 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">Pertama, pastikan koneksi internet Anda stabil. Coba segarkan (refresh) halaman atau gunakan browser yang berbeda. Jika masalah berlanjut, jangan ragu untuk menghubungi tim support kami melalui email atau live chat.</p>
                            </div>
                        </div>

                        {{-- FAQ 5 (TAMBAHAN) --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm enhanced-transition hover:border-indigo-300">
                            <button class="flex justify-between items-center w-full text-left px-5 py-4 cursor-pointer" onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-800">Bagaimana cara berinteraksi dengan pengajar?</h4>
                                <i class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-300 transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-4 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">Setiap kelas memiliki forum diskusi khusus di mana Anda dapat mengajukan pertanyaan langsung kepada pengajar dan berdiskusi dengan sesama siswa. Selain itu, kami juga mengadakan sesi tanya jawab langsung (live Q&A) secara berkala.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
            <x-footer></x-footer>
        </div>
    </div>

    {{-- KODE JAVASCRIPT FINAL --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var swiper = new Swiper(".mySwiper", { loop: true, slidesPerView: 'auto', centeredSlides: true, spaceBetween: 16, autoplay: { delay: 3000, disableOnInteraction: false }, pagination: { el: ".swiper-pagination", clickable: true }, navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" } });
        var investorSwiper = new Swiper(".investorSwiper", { loop: true, slidesPerView: 'auto', spaceBetween: 40, autoplay: { delay: 2500, disableOnInteraction: false }});

        function toggleFAQ(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector("i");
            content.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");
        }

        // Fungsi Chart dengan warna yang sudah diperbaiki
        function createRadialChart(elementId, value, label, color) {
            var options = {
                chart: {
                    height: 250,
                    type: "radialBar"
                },
                series: [value],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "60%"
                        },
                        track: {
                            background: '#818cf8', // Warna ungu muda untuk track
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            showOn: "always",
                            name: {
                                show: false
                            },
                            value: {
                                color: "white",
                                fontSize: "40px",
                                fontWeight: "600",
                                show: true,
                                formatter: function(val) {
                                    return label === 'Progress Overall' ? val + '%' : val;
                                }
                            }
                        }
                    }
                },
                fill: {
                    colors: [color]
                },
                stroke: {
                    lineCap: "round",
                },
                labels: [label]
            };
            var chart = new ApexCharts(document.querySelector(elementId), options);
            chart.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Memanggil fungsi chart dengan variabel Blade Anda
            createRadialChart('#finishedChart', {{ $finishedCourseCount }}, 'Finished Course', '#ffffff');
            createRadialChart('#ongoingChart', {{ $ongoingCourseCount }}, 'Ongoing Course', '#ffffff');
            createRadialChart('#overallChart', {{ $overallProgress }}, 'Progress Overall', '#ffffff');

            // JavaScript untuk animasi saat scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.reveal').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>