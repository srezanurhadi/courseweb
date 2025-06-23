<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* swiper header */
        .swiper-button-next::after,
        .swiper-button-prev::after {
            content: '';
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            opacity: 1;
            transition-property: background-color, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
            display: inline-block
        }

        .swiper-pagination-bullet:hover {
            background-color: white;
        }

        .swiper-pagination-bullet-active {
            background-color: white;
        }

        .mySwiper {
            height: 100%;
            /*carousel height */
        }

        .swiper-slide img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        /* swiper investor */
        .investorswiper-button-next::after,
        .investorswiper-button-prev::after {
            content: '';
        }

        .investorSwiper {
            height: 120px;
            width: 100%;
        }

        .investorSwiper .swiper-slide {
            width: auto !important;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .investorSwiper .swiper-slide img {
            object-fit: contain;
            max-width: 100%;
            width: 400px;
            padding: 10px;
            box-sizing: border-box;
        }

        .swiper-wrapper {
            align-items: center;
        }

        .chart-container {
            width: 300px;
            background: #3D7FBA;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .chart-title {
            font-weight: 600;
            font-size: 18px;
            color: white;
            /* margin-top: 4px; */
        }

        /* Custom ApexCharts styling */
        /* .apexcharts-canvas {
            margin: 0 auto;
        } */
    </style>
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="flex-1">
            {{-- - Navbar - --}}
            <nav class="bg-white shadow-md z-50 sticky top-0">
                <div class="px-6 py-0.5">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center px-4">
                            <h1 class="text-3xl font-bold text-gray-800">Home</h1>
                        </div>
                        <div class="flex items-center space-x-4 px-4">
                            <button>
                                <i class="fa-regular fa-bell fa-lg text-black hover:text-gray-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 px-3">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-300 overflow-hidden">
                                    @if (Auth::user()->image)
                                        {{-- Jika user punya foto, tampilkan foto --}}
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan inisial --}}
                                        <span class="text-xl font-semibold leading-none text-gray-700">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </span>
                                <span class="text-xl font-semibold text-gray-700">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- - Content Area - --}}
            <div>
                <header
                    class="bg-indigo-100 h-[400px] rounded-b-3xl mb-4 flex justify-center items-center relative overflow-hidden">
                    <div class="wrapper max-w-[1152px] relative w-full mx-4 h-[350px]">
                        <div class="swiper mySwiper w-full h-full">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=500&fit=crop&crop=faces"
                                        alt="Office workspace" class="h-full w-full rounded-lg shadow-md">
                                </div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&h=500&fit=crop&crop=center"
                                        alt="Modern building" class="h-full w-full rounded-lg shadow-md">
                                </div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=800&h=500&fit=crop&crop=center"
                                        alt="Team meeting" class="h-full w-full rounded-lg shadow-md">
                                </div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop&crop=center"
                                        alt="Business discussion" class="h-full w-full rounded-lg shadow-md">
                                </div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&h=500&fit=crop&crop=center"
                                        alt="Technology" class="h-full w-full rounded-lg shadow-md">
                                </div>
                                <div class="swiper-slide !w-[700px] flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1553028826-f4804a6dba3b?w=800&h=500&fit=crop&crop=center"
                                        alt="Growth chart" class="h-full w-full rounded-lg shadow-md">
                                </div>
                            </div>
                            <div class="swiper-pagination">
                            </div>
                        </div>

                        <div
                            class="swiper-button-prev absolute left-4 top-1/2 transform -translate-y-1/2 transition-all duration-200 hover:scale-110 cursor-pointer">
                            <i class="fa-solid fa-caret-left text-6xl text-white/80 hover:text-white"></i>
                        </div>
                        <div
                            class="swiper-button-next absolute right-4 top-1/2 transform -translate-y-1/2 transition-all duration-200 hover:scale-110 cursor-pointer">
                            <i class="fa-solid fa-caret-right text-6xl text-white/80 hover:text-white"></i>
                        </div>
                    </div>
                </header>

                <div class="mb-8">
                    <h1 class="text-center font-bold text-2xl mb-6">My Progress</h1>
                    <div class="max-w-6xl mx-auto px-2">
                        <div class="flex flex-cols-3 justify-center gap-8">
                            <!-- Finished Course Chart -->
                            <div class="chart-container">
                                <div id="finishedChart" class="w-full"></div>
                                <p class="chart-title">Finished Course</p>
                            </div>

                            <!-- Ongoing Course Chart -->
                            <div class="chart-container">
                                <div id="ongoingChart" class="w-full"></div>
                                <p class="chart-title">Ongoing Course</p>
                            </div>

                            <!-- Progress Overall Chart -->
                            <div class="chart-container">
                                <div id="overallChart" class="w-full"></div>
                                <p class="chart-title">Progress Overall</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h1 class="text-center font-bold text-2xl mb-6">Achieve Your Dreams with R. DOSEN</h1>
                    <div class="grid grid-cols-4 gap-5 mx-[85px] items-stretch">
                        <div
                            class="flex flex-col items-center text-center bg-indigo-100 rounded-lg shadow-lg/10 p-4 border border-gray-300">
                            <img src="https://cdn-icons-png.flaticon.com/512/7051/7051237.png" alt="Icon"
                                class="w-25 h-25 mb-2">
                            <p class="font-semibold leading-tight text-lg text-indigo-800">
                                Over 1.5 Million+ Members
                                <br />
                                Learning Together
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center text-center bg-indigo-100 rounded-lg shadow-lg/10 p-4 border border-gray-300">
                            <img src="https://cdn-icons-png.flaticon.com/512/639/639343.png" alt="Icon"
                                class="w-25 h-25 mb-2">
                            <p class="font-semibold leading-tight text-lg text-indigo-800">
                                Thousands of Alumni Work in National & Global Companies
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center text-center bg-indigo-100 rounded-lg shadow-lg/10 p-4 border border-gray-300">
                            <img src="https://cdn-icons-png.flaticon.com/512/3330/3330423.png" alt="Icon"
                                class="w-25 h-25 mb-2">
                            <p class="font-semibold leading-tight text-lg text-indigo-800">
                                Certified
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center text-center bg-indigo-100 rounded-lg shadow-lg/10 p-4 border border-gray-300">
                            <img src="https://cdn-icons-png.flaticon.com/512/12836/12836911.png" alt="Icon"
                                class="w-25 h-25 mb-2">
                            <p class="font-semibold leading-tight text-lg text-indigo-800">
                                50k++ New Members Learning per Month
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h1 class="text-center font-bold text-2xl mb-6">Investors and Affiliations</h1>
                    <div class="max-w-6xl mx-auto relative overflow-hidden px-2">
                        <div class="swiper investorSwiper h-full">
                            <div class="swiper-wrapper w-full h-[150px]">
                                <div class="swiper-slide">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjWOHn77fEZlM042r9lFIpXf9dVP8DLik56Q&s"
                                        alt="Investor Logo 1" class="rounded-lg border border-gray-300">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://dqlab.id/files/dqlab/file/data-web-1/data-user-2/20241016103945.png"
                                        alt="Investor Logo 1" class="rounded-lg border border-gray-300">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://manage.aseanbacindonesia.id/uploads/East_Ventures_logo_color_eccaf8ac56.png"
                                        alt="Investor Logo 1" class="rounded-lg border border-gray-300">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://startupstudio.id/wp-content/uploads/2021/04/Vertical-Lockup-on-White-2-1024x433.png"
                                        alt="Investor Logo 1" class="rounded-lg border border-gray-300">
                                </div>
                            </div>
                        </div>
                        <div
                            class="investorswiper-button-prev absolute left-4 top-1/2 transform -translate-y-1/2 z-20  transition-all duration-200 hover:scale-110 cursor-pointer drop-shadow-[0_4px_10px_rgba(255,255,255,0.8)]">
                            <i class="fa-solid fa-caret-left text-6xl text-gray-700/70 hover:text-gray-700"></i>
                        </div>
                        <div
                            class="investorswiper-button-next absolute right-4 top-1/2 transform -translate-y-1/2 z-20  transition-all duration-200 hover:scale-110 cursor-pointer drop-shadow-[0_4px_10px_rgba(255,255,255,0.8)]">
                            <i class="fa-solid fa-caret-right text-6xl text-gray-700/70 hover:text-gray-700"></i>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h1 class="text-center font-bold text-2xl mb-6">Frequently Asked Questions (FAQ)</h1>
                    <div class="max-w-6xl mx-auto space-y-3 px-2">
                        {{-- FAQ items --}}
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <button
                                class="flex justify-between items-center w-full text-left px-5 py-3.5 rounded-xl cursor-pointer"
                                onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-700">
                                    Bagaimana cara menyampaikan keluhan atau pengaduan?
                                </h4>
                                <i
                                    class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-200 ease-in-out transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-3 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">
                                    Anda dapat menyampaikan keluhan atau pengaduan melalui
                                </p>
                            </div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <button
                                class="flex justify-between items-center w-full text-left px-5 py-3.5 rounded-xl cursor-pointer"
                                onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-700">
                                    Bagaimana cara menyampaikan keluhan atau pengaduan?
                                </h4>
                                <i
                                    class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-200 ease-in-out transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-3 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">
                                    Anda dapat menyampaikan keluhan atau pengaduan melalui
                                </p>
                            </div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <button
                                class="flex justify-between items-center w-full text-left px-5 py-3.5 rounded-xl cursor-pointer"
                                onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-700">
                                    Bagaimana cara menyampaikan keluhan atau pengaduan?
                                </h4>
                                <i
                                    class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-200 ease-in-out transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-3 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">
                                    Anda dapat menyampaikan keluhan atau pengaduan melalui
                                </p>
                            </div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <button
                                class="flex justify-between items-center w-full text-left px-5 py-3.5 rounded-xl cursor-pointer"
                                onclick="toggleFAQ(this)">
                                <h4 class="text-lg font-medium text-gray-700">
                                    Bagaimana cara menyampaikan keluhan atau pengaduan?
                                </h4>
                                <i
                                    class="fa-solid fa-chevron-down text-gray-500 transition-transform duration-200 ease-in-out transform"></i>
                            </button>
                            <div class="px-5 pt-1 pb-3 text-base text-gray-600 hidden">
                                <p class="leading-relaxed">
                                    Anda dapat menyampaikan keluhan atau pengaduan melalui
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 16,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var investorSwiper = new Swiper(".investorSwiper", {
            loop: true,
            slidesPerView: 'auto',
            spaceBetween: 16,
            navigation: {
                nextEl: ".investorswiper-button-next",
                prevEl: ".investorswiper-button-prev",
            },
        });

        // FAQ Toggle Function 
        function toggleFAQ(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector("i");

            content.classList.toggle("hidden");

            if (content.classList.contains("hidden")) {
                icon.classList.remove("rotate-180");
            } else {
                icon.classList.add("rotate-180");
            }
        }

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
                            background: '#f1f5f9',
                            strokeWidth: '100%',
                        },
                        dataLabels: {
                            showOn: "always",
                            name: {
                                show: false
                            },
                            value: {
                                color: "white",
                                fontSize: "55px",
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

        // Initialize charts after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            var finishedChartOptions = {
                chart: {
                    height: 250,
                    type: "radialBar"
                },
                series: [{{ $finishedCoursePercentage }}], // <-- Gunakan PERSENTASE untuk visual
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "60%"
                        },
                        track: {
                            background: '#f1f5f9',
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            showOn: "always",
                            name: {
                                show: false
                            },
                            value: {
                                color: "white",
                                fontSize: "55px",
                                fontWeight: "600",
                                show: true,
                                formatter: function(val) {
                                    // Tampilkan JUMLAH NOMINAL sebagai teks, bukan persentase
                                    return {{ $finishedCourseCount }};
                                }
                            }
                        }
                    }
                },
                fill: {
                    colors: ['#5A1495']
                },
                stroke: {
                    lineCap: "round"
                },
                labels: ['Finished Course']
            };
            var finishedChart = new ApexCharts(document.querySelector("#finishedChart"), finishedChartOptions);
            finishedChart.render();
            createRadialChart('#ongoingChart', {{ $ongoingCourseCount }}, 'Ongoing Course', '#5A1495');
            createRadialChart('#overallChart', {{ $overallProgress }}, 'Progress Overall', '#5A1495');
        });
    </script>
</body>

</html>
