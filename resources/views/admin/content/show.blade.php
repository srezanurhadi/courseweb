<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>
    @vite('resources/css/app.css') 
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class=" w-full bg-gray-50 ">
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky">
                <div class="text-3xl font-bold pl-4">Management Course</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>
            <div class="w-full flex pt-8 px-4 justify-between pb-2">
                <div class="w-full flex flex-wrap gap-2 font-semibold">
                    <div class="w-full flex gap-2 items-center p-2">
                        <div class=" text-indigo-700"> <a href="{{ url()->previous() }}">
                                <i class="fa-solid fa-play rotate-180">
                                </i>
                                <span class="pl-2">Back</span>
                            </a>
                        </div>
                        <div class=" py-0.5 px-3 border-amber-500 text-amber-500 bg-amber-100 rounded-sm border-2">
                            <i class="fas fa-pencil-alt"></i> <span class="pl-2">Edit</span>
                        </div>
                        <div class=" py-0.5 px-3 border-rose-500 text-rose-500 bg-rose-100 rounded-sm border-2">
                            <i class="fas fa-trash"></i> <span class="pl-2">Delete</span>
                        </div>
                    </div>

                    <div class="w-full p-4 bg-gray-100 rounded-lg shadow-[0px_1px_2px_1px_rgba(0,0,0,0.4)]">
                        <div class="font-bold text-xl mb-6">
                            1. Content 1 {{-- Judul dari database --}}
                        </div>
                        <div class="w-full max-w-3xl mx-auto"> 
                            @if (isset($editorJsData) && is_array($editorJsData['blocks']))
                                @foreach ($editorJsData['blocks'] as $block)
                                    @switch ($block['type'])
                                        @case('paragraph')
                                            {{-- Beri jarak bawah pada setiap paragraf --}}
                                            <p class="mb-4 text-gray-700 leading-relaxed">{!! $block['data']['text'] !!}</p>
                                        @break

                                        @case('header')
                                            @php
                                                $level = $block['data']['level'];
                                                $tag = 'h' . $level;
                                                // Atur ukuran dan jarak sesuai level heading
                                                $classes = [
                                                    'h1' => 'text-4xl font-bold mt-8 mb-4',
                                                    'h2' => 'text-3xl font-bold mt-8 mb-4 border-b pb-2',
                                                    'h3' => 'text-2xl font-bold mt-6 mb-3',
                                                    'h4' => 'text-xl font-bold mt-6 mb-3',
                                                    'h5' => 'text-lg font-bold mt-4 mb-2',
                                                    'h6' => 'text-base font-bold mt-4 mb-2',
                                                ];
                                            @endphp
                                            {{-- Terapkan class yang sesuai --}}
                                            <{!! $tag !!} class="{{ $classes[$tag] ?? '' }}">{!! $block['data']['text'] !!}
                                                </{!! $tag !!}>
                                            @break

                                            @case('image')
                                                <figure class="my-8"> {{-- Beri jarak atas/bawah yang lebih besar untuk gambar --}}
                                                    <img src="{{ $block['data']['file']['url'] }}"
                                                        alt="{{ $block['data']['caption'] ?? 'Image' }}"
                                                        class="w-3/4 h-auto rounded-lg shadow-md mx-auto"> {{-- Gambar akan mengisi lebar kontainer --}}
                                                    @if ($block['data']['caption'])
                                                        <figcaption class="text-center text-sm text-gray-500 mt-2 italic">
                                                            {{ $block['data']['caption'] }}</figcaption>
                                                    @endif
                                                </figure>
                                            @break

                                            @case('list')
                                                {{-- Beri style untuk list dan jarak antar item --}}
                                                @if ($block['data']['style'] === 'unordered')
                                                    <ul class="list-disc pl-5 mb-4 space-y-2">
                                                        @foreach ($block['data']['items'] as $item)
                                                            <li>{!! $item !!}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <ol class="list-decimal pl-5 mb-4 space-y-2">
                                                        @foreach ($block['data']['items'] as $item)
                                                            <li>{!! $item !!}</li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            @break

                                            @case('quote')
                                                {{-- Buat blockquote menonjol --}}
                                                <blockquote class="my-6 p-4 border-l-4 border-gray-400 bg-gray-50 italic">
                                                    <p class="text-xl font-medium leading-relaxed text-gray-800">
                                                        {!! $block['data']['text'] !!}</p>
                                                    @if ($block['data']['caption'])
                                                        <footer class="mt-2 text-base text-gray-600">—
                                                            {{ $block['data']['caption'] }}</footer>
                                                    @endif
                                                </blockquote>
                                            @break

                                            @case('delimiter')
                                                <hr class="my-8">
                                            @break

                                            {{-- Anda bisa menambahkan styling untuk 'code', 'table', dll. --}}
                                        @endswitch
                                @endforeach
                            @else
                                <p class="text-gray-500 italic">Tidak ada konten yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script></script>

</html>
