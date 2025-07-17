{{-- File ini akan menerima satu variabel: $item --}}
<li>
    {{-- Render konten dari item saat ini --}}
    {!! $item['content'] !!}
    @if (!empty($item['items']))
        {{-- Kita asumsikan sub-list selalu <ul>, atau Anda bisa menambahkan logika style jika perlu --}}
        <ul class="list-disc pl-5 mt-2 space-y-2">
            @foreach ($item['items'] as $subItem)
                @include('partials._list_item', ['item' => $subItem])
            @endforeach
        </ul>
    @endif
</li>