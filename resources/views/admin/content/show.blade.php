<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>
    {{-- Pastikan Tailwind CSS Typography Plugin diaktifkan di tailwind.config.js Anda --}}
    @vite('resources/css/app.css') {{-- Jika Anda menggunakan Vite --}}
    {{-- Atau <link href="{{ asset('css/app.css') }}" rel="stylesheet"> jika Anda menggunakan Mix --}}
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
                    <div
                        class="w-full p-4 bg-gray-100 rounded-lg shadow-[0px_1px_2px_1px_rgba(0,0,0,0.4)] flex flex-wrap gap-2 h-200">
                        {{-- ini bagian judul --}}
                        <p class="w-full">
                            1. Content 1 {{-- Anda mungkin ingin mengganti ini dengan judul dinamis dari data Anda --}}
                        </p>

                        {{-- --- EDITOR.JS CONTENT RENDERING START --- --}}
                        <div class=" max-w-none w-full"> {{-- Gunakan Tailwind Typography Plugin di sini --}}
                            @if (isset($editorJsData) && is_array($editorJsData['blocks']))
                                @foreach ($editorJsData['blocks'] as $block)
                                    @switch ($block['type'])
                                        @case('paragraph')
                                            <p>{!! $block['data']['text'] !!}</p>
                                        @break

                                        @case('header')
                                            @php
                                                $level = $block['data']['level'];
                                                $tag = 'h' . $level;
                                            @endphp
                                            <{!! $tag !!}>{!! $block['data']['text'] !!}</{!! $tag !!}>
                                            @break

                                            @case('image')
                                                <figure class="my-6">
                                                    <img src="{{ $block['data']['file']['url'] }}"
                                                        alt="{{ $block['data']['caption'] ?? 'Image' }}"
                                                        class=" mx-auto rounded-lg shadow-md  {{ $block['data']['stretched'] ? 'w-full' : 'max-w-200' }}">
                                                    @if ($block['data']['caption'])
                                                        <figcaption class="text-center text-sm text-gray-600 mt-2">
                                                            {{ $block['data']['caption'] }}</figcaption>
                                                    @endif
                                                </figure>
                                            @break

                                            @case('list')
                                                @if ($block['data']['style'] === 'unordered')
                                                    <ul>
                                                        @foreach ($block['data']['items'] as $item)
                                                            <li>{!! $item !!}</li>
                                                        @endforeach
                                                    </ul>
                                                @elseif ($block['data']['style'] === 'ordered')
                                                    <ol>
                                                        @foreach ($block['data']['items'] as $item)
                                                            <li>{!! $item !!}</li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            @break

                                            @case('delimiter')
                                                <hr class="my-8 border-t-2 border-gray-300 w-24 mx-auto">
                                            @break

                                            @case('quote')
                                                <blockquote>
                                                    <p>{!! $block['data']['text'] !!}</p>
                                                    @if ($block['data']['caption'])
                                                        <footer>— {{ $block['data']['caption'] }}</footer>
                                                    @endif
                                                </blockquote>
                                            @break

                                            @case('code')
                                                <pre><code>{!! htmlspecialchars($block['data']['code']) !!}</code></pre>
                                            @break

                                            @case('table')
                                                <div class="overflow-x-auto my-6">
                                                    <table>
                                                        <tbody>
                                                            @foreach ($block['data']['content'] as $row)
                                                                <tr>
                                                                    @foreach ($row as $cell)
                                                                        <td>{!! $cell !!}</td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @break

                                            @default
                                                <p class="text-red-500">
                                                    Tipe blok tidak dikenal: {{ $block['type'] }}
                                                </p>
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
