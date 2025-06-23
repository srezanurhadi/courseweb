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
                            <div class="font-bold text-xl mb-6 px-2">
                                {{ $content->title }}
                            </div>
                            <div class="w-full max-w-3xl mx-auto ">
                                @if (isset($editorJsData) && is_array($editorJsData['blocks']))
                                    @foreach ($editorJsData['blocks'] as $block)
                                        @switch ($block['type'])
                                            {{-- DISEMPURNAKAN: Menambahkan dukungan alignment --}}
                                            @case('paragraph')
                                                @php
                                                    // Tentukan class alignment berdasarkan data, default 'text-left'
                                                    $alignment = $block['data']['alignment'] ?? 'left';
                                                    $alignmentClass = [
                                                        'left' => 'text-left',
                                                        'center' => 'text-center',
                                                        'right' => 'text-right',
                                                        'justify' => 'text-justify',
                                                    ][$alignment];
                                                @endphp
                                                <p class="mb-4 text-gray-700 leading-relaxed {{ $alignmentClass }}">
                                                    {!! $block['data']['text'] !!}</p>
                                            @break

                                            @case('header')
                                                @php
                                                    $level = $block['data']['level'];
                                                    $tag = 'h' . $level;
                                                    $classes = [
                                                        'h1' => 'text-4xl font-bold mt-8 mb-4',
                                                        'h2' => 'text-3xl font-bold mt-8 mb-4 border-b pb-2',
                                                        'h3' => 'text-2xl font-bold mt-6 mb-3',
                                                        'h4' => 'text-xl font-bold mt-6 mb-3',
                                                        'h5' => 'text-lg font-bold mt-4 mb-2',
                                                        'h6' => 'text-base font-bold mt-4 mb-2',
                                                    ];
                                                @endphp
                                                <{!! $tag !!} class="{{ $classes[$tag] ?? '' }}">{!! $block['data']['text'] !!}
                                                    </{!! $tag !!}>
                                                @break

                                                @case('image')
                                                    {{-- SANGAT DIREKOMENDASIKAN menggunakan versi yang lebih aman ini --}}
                                                    @php
                                                        $isStretched = $block['data']['stretched'] ?? false;
                                                        $hasBorder = $block['data']['withBorder'] ?? false;
                                                        $hasBackground = $block['data']['withBackground'] ?? false;

                                                        $figureClasses = [
                                                            'my-8',
                                                            'mx-auto',
                                                            'rounded-lg',
                                                            'overflow-hidden',
                                                            'shadow-md',
                                                            $isStretched ? 'w-full' : 'max-w-full lg:w-5/6',
                                                            $hasBorder ? 'border-2 border-slate-800' : 'border-none',
                                                            $hasBackground ? 'p-4 sm:p-6 bg-slate-100' : '',
                                                        ];
                                                    @endphp
                                                    <figure class="{{ implode(' ', array_filter($figureClasses)) }}">
                                                        <img src="{{ $block['data']['file']['url'] }}"
                                                            alt="{{ $block['data']['caption'] ?? 'Image' }}"
                                                            class="w-full h-full object-cover">
                                                        @if (!empty($block['data']['caption']))
                                                            <figcaption class="text-center text-sm text-gray-500 mt-2 italic">
                                                                {{ $block['data']['caption'] }}
                                                            </figcaption>
                                                        @endif
                                                    </figure>
                                                @break

                                                @case('list')
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
                                                    <blockquote class="my-6 p-4 border-l-4 border-gray-400 bg-gray-50 italic">
                                                        <p class="text-xl font-medium leading-relaxed text-gray-800">
                                                            {!! $block['data']['text'] !!}</p>
                                                        @if (!empty($block['data']['caption']))
                                                            <footer class="mt-2 text-base text-gray-600">—
                                                                {{ $block['data']['caption'] }}</footer>
                                                        @endif
                                                    </blockquote>
                                                @break

                                                @case('delimiter')
                                                    <hr class="my-8">
                                                @break

                                                {{-- BARU: Menambahkan dukungan untuk CodeTool --}}
                                                @case('code')
                                                    <pre class="bg-gray-800 text-white text-sm rounded-lg p-4 my-6 overflow-x-auto"><code class="font-mono">{!! htmlspecialchars($block['data']['code']) !!}</code></pre>
                                                @break

                                                {{-- BARU: Menambahkan dukungan untuk Table --}}
                                                @case('table')
                                                    @php
                                                        $withHeadings = $block['data']['withHeadings'] ?? false;
                                                        $content = $block['data']['content'];
                                                        $header =
                                                            $withHeadings && count($content) > 0
                                                                ? array_shift($content)
                                                                : null;
                                                        $body = $content;
                                                    @endphp
                                                    <div class="my-6 overflow-x-auto">
                                                        <table class="min-w-full border border-gray-300">
                                                            @if ($header)
                                                                <thead class="bg-gray-100">
                                                                    <tr>
                                                                        @foreach ($header as $cell)
                                                                            <th
                                                                                class="p-3 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">
                                                                                {!! $cell !!}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                            @endif
                                                            <tbody>
                                                                @foreach ($body as $row)
                                                                    <tr class="hover:bg-gray-50">
                                                                        @foreach ($row as $cell)
                                                                            <td class="p-3 border-b border-gray-300 text-gray-700">
                                                                                {!! $cell !!}</td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @break
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
