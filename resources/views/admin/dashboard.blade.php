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
                <div class="text-3xl font-bold pl-4">Dashboard</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            {{-- head --}}
            <div class="mt-2 p-4 space-y-5">
                <div class="flex justify-around gap-5">
                    <div
                        class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">All Course</div>
                            <div class="text-3xl text-indigo-700 pl-4">{{ $coursescount }}</div>
                        </div>
                        <div
                            class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                            <i class="fas fa-book-open text-xl text-indigo-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2 ">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Active Course</div>
                            <div class="text-3xl text-green-700 pl-4">{{ $coursesactive }}</div>
                        </div>
                        <div class="rounded-full justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                            <i class="fas fa-check text-2xl text-green-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/3 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Drafted Course</div>
                            <div class="text-3xl text-amber-500 pl-4">{{ $coursesdraft }}</div>
                        </div>
                        <div class="rounded-full justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                            <i class="fas fa-pen-to-square text-2xl text-amber-500"></i>
                        </div>
                    </div>
                </div>
                <div class="flex justify-around gap-5">
                    <div
                        class="border-l-4 border-indigo-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Content Total</div>
                            <div class="text-3xl text-indigo-700 pl-4">{{ $ContentCount }}</div>
                        </div>
                        <div
                            class="rounded-full text-indigo-200 justify-center flex items-center bg-indigo-300 h-10 w-10 m-4">
                            <i class="fas fa-book text-2xl text-indigo-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-amber-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Category</div>
                            <div class="text-3xl text-amber-500 pl-4">{{ $categories }}</div>
                        </div>
                        <div class="rounded-full justify-center flex items-center bg-amber-200 h-10 w-10 m-4">
                            <i class="fas fa-tag text-2xl text-amber-500"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-green-700 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2 ">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Used</div>
                            <div class="text-3xl text-green-700 pl-4">{{ $ContentCount - $unusedContentCount }}</div>
                        </div>
                        <div class="rounded-full justify-center flex items-center bg-green-300 h-10 w-10 m-4">
                            <i class="fas fa-check text-2xl text-green-700"></i>
                        </div>
                    </div>
                    <div
                        class="border-l-4 border-rose-500 bg-gray-100 shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl w-1/4 flex justify-between items-center pl-2">
                        <div class="p-2 flex flex-col font-semibold ">
                            <div class="text-base text-gray-800">Unused</div>
                            <div class="text-3xl text-rose-500 pl-4">{{ $unusedContentCount }}</div>
                        </div>
                        <div class="rounded-full justify-center flex items-center bg-rose-200 h-10 w-10 m-4">
                            <i class="fas fa-xmark text-2xl text-rose-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 p-4 flex flex-row justify-center items-center gap-5">
                <div class="w-7/12" id="chart1"></div>
                <div class="w-5/12" id="chart2"></div>

            </div>
            <div class="mb-5 p-4">
                {{-- Card Utama --}}
                <div class="mx-auto w-full p-6 bg-white shadow-[0px_0px_2px_1px_rgba(0,0,0,0.4)] rounded-xl">

                    {{-- Header Section --}}
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Kursus Populer</h3>
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">Lihat
                            Semua</a>
                    </div>

                    {{-- List Kursus --}}
                    <div class="space-y-5">

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-red-100 p-2 rounded-lg h-10 w-10">
                                    <i class="fas fa-code text-xl text-red-500"></i>
                                </div>
                                <span class="text-gray-700 font-medium truncate max-w-xs md:max-w-md">
                                    Tutorial HTML dan lain lain yang tidak terlalu penting
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-red-500">
                                <i class="fas fa-users"></i>
                                <span class="font-semibold text-sm">44 Participant</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-green-100 p-3 rounded-lg  h-10 w-10">
                                    <i class="fab fa-css3-alt text-xl text-green-500"></i>
                                </div>
                                <span class="text-gray-700 font-medium truncate max-w-xs md:max-w-md">
                                    Tutorial CSS atau Tailwind dan lain lain yang tidak terlalu penting
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-green-500">
                                <i class="fas fa-users"></i>
                                <span class="font-semibold text-sm">35 Participant</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-100 p-2 rounded-lg  h-10 w-10">
                                    <i class="fas fa-laptop-code text-xl text-blue-500"></i>
                                </div>
                                <span class="text-gray-700 font-medium truncate max-w-xs md:max-w-md">
                                    Laravel Itu Menyenangkan ya gessssssssssss...
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-blue-500">
                                <i class="fas fa-users"></i>
                                <span class="font-semibold text-sm">25 Participant</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // --- Konfigurasi dan Render untuk Bar Chart ---
    var optionsBar = {
        chart: {
            type: 'bar',
            height: 350
        },
        colors: ['#303F9F'],
        title: {
            text: 'Total Pendaftaran Tiap Bulan',
            align: 'center',
            style: {
                fontSize: '16px',
                fontWeight: 'bold',
                color: '#1E2939'
            }
        },
        series: [{

            name: 'Sales',
            data: [30, 40, 45, 50, 49, 60, 70, 91, 125, 80, 90, 100]
        }],
        xaxis: {
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November',
                'Desember'
            ]
        }

    };

    var chartBar = new ApexCharts(document.querySelector("#chart1"), optionsBar);
    chartBar.render();


    // --- Konfigurasi dan Render untuk Pie Chart ---
    var optionsPie = {
        series: [40, 25, 35],
        chart: {
            width: 450,
            type: 'pie',
        },
        colors: ['#303F9F', '#388E3C', '#f59e0b'],
        labels: ['Admin', 'Author', 'Participant'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]

    };

    var chartPie = new ApexCharts(document.querySelector("#chart2"), optionsPie);
    chartPie.render();
</script>


</html>
