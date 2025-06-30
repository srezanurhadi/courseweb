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
                <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-10">
                    <div class="text-3xl font-bold pl-4">Management Content</div>
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
                            <div
                                class=" text-indigo-700 hover:text-indigo-600  hover:text-shadow-sm transition-all duration-300">
                                <a href="{{ url()->previous() }}">
                                    <i class="fa-solid fa-play rotate-180">
                                    </i>
                                    <span class="pl-2">Back</span>
                                </a>
                            </div>
                            <a href="/admin{{ Request::is('admin/mycontent*') ? '/mycontent' : '/content' }}/{{ $content->slug }}/edit"
                                class=" py-0.5 px-3 border-amber-500 text-amber-500 hover:bg-amber-50  bg-amber-100 rounded-sm border-2 transition-all duration-200 shadow-inherit">
                                <i class="fas fa-pencil-alt"></i> <span class="pl-2">Edit</span>
                            </a>
                            <form
                                action="/admin{{ Request::is('admin/mycontent*') ? '/mycontent' : '/content' }}/{{ $content->slug }}"
                                method="POST" class="inline-block">
                                @method('delete')
                                @csrf
                                <button type="button"
                                    class="delete-btn py-0.5 px-3 border-rose-500 text-rose-500 bg-rose-100 rounded-sm border-2 hover:bg-rose-50 transition-all duration-200 cursor-pointer"
                                    data-title="{{ $content->title }}">
                                    <i class="fas fa-trash"></i> <span class="pl-2">Delete</span>
                                </button>
                            </form>

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
                                                <{!! $tag !!} class="{{ $classes[$tag] ?? '' }}">
                                                    {!! $block['data']['text'] !!}
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
                                                    {{-- Menangani Unordered dan Ordered List --}}
                                                    @if ($block['data']['style'] === 'unordered' || $block['data']['style'] === 'ordered')
                                                        @if ($block['data']['style'] === 'unordered')
                                                            <ul class="list-disc pl-5 mb-4 space-y-2">
                                                            @else
                                                                <ol class="list-decimal pl-5 mb-4 space-y-2">
                                                        @endif
                                                        @foreach ($block['data']['items'] as $item)
                                                            {{-- PASTIKAN item tidak kosong dan memiliki key 'content' --}}
                                                            @if (is_array($item) && !empty($item['content']))
                                                                <li>{!! $item['content'] !!}</li>
                                                            @endif
                                                        @endforeach
                                                        @if ($block['data']['style'] === 'unordered')
                                                            </ul>
                                                        @else
                                                            </ol>
                                                        @endif

                                                        {{-- BARU: Menangani Checklist --}}
                                                    @elseif ($block['data']['style'] === 'checklist')
                                                        <div class="mb-4 space-y-2">
                                                            @foreach ($block['data']['items'] as $item)
                                                                {{-- PASTIKAN item tidak kosong dan memiliki key 'content' --}}
                                                                @if (is_array($item) && isset($item['content']))
                                                                    <div class="flex items-center">
                                                                        <input type="checkbox"
                                                                            class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                                            {{ $item['meta']['checked'] ?? false ? 'checked' : '' }}
                                                                            disabled>
                                                                        <label
                                                                            class="ml-2 text-gray-700">{!! $item['content'] !!}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
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
                                                                            <td
                                                                                class="p-3 border-b border-gray-300 text-gray-700">
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
                <div id="delete-confirmation-modal"
                    class="fixed inset-0 z-[100] flex items-center bg-white/10 justify-center transition-all duration-150 ease-in-out opacity-0 scale-95 pointer-events-none">
                    <div
                        class="bg-white/50 backdrop-blur-xs border-2 border-gray-200 rounded-lg shadow-sm w-full max-w-md mx-4 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-4 text-left">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                        Konfirmasi Hapus
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">
                                            Apakah Anda yakin ingin menghapus konten
                                            <strong id="content-title-to-delete" class="text-gray-900"></strong>?
                                            <br>Tindakan ini tidak dapat dibatalkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                            <button type="button" id="confirmDeleteBtn"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Ya, Hapus
                            </button>
                            <button type="button" id="cancelDeleteBtn"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-confirmation-modal');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const contentTitleElement = document.getElementById('content-title-to-delete');

            let formToSubmit = null;

            const showModal = (form, title) => {
                formToSubmit = form;
                contentTitleElement.textContent = `'${title}'`;
                modal.classList.remove('pointer-events-none');
                setTimeout(() => {
                    modal.classList.add('opacity-100', 'scale-100');
                    modal.classList.remove('opacity-0', 'scale-95');
                }, 10);
            };

            const hideModal = () => {
                modal.classList.remove('opacity-100', 'scale-100');
                modal.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    formToSubmit = null;
                    contentTitleElement.textContent = '';
                }, 300);
            };

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const title = this.dataset.title;
                    showModal(form, title);
                });
            });

            confirmDeleteBtn.addEventListener('click', () => {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });

            cancelDeleteBtn.addEventListener('click', hideModal);

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    hideModal();
                }
            });
        });
    </script>

    </html>
