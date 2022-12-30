<div class="mt-4">
    <div>
        {!! $getState() !!}
    </div>
    <div class="mt-4">
        <p class="italic text-sm">Choices</p>
        <ul>
            @foreach ($getRecord()->choices as $choice)
                <li>
                    <x-heroicon-o-arrow-sm-right class="w-4 inline" /> {!! $choice !!}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-4">
        <p class="italic text-sm">Answer</p>
        <p class="inline-block px-2 rounded-full font-semibold text-sm bg-green-200 text-green-700">
            {!! $getRecord()->choices[$getRecord()->answer] ?? $getRecord()->answer !!}</p>
    </div>

    @if ($getRecord()->explanation)
        <div class="mt-4">
            <p class="italic text-sm">Explanation</p>
            <p class="mt-2 text-sm">{!! $getRecord()->explanation !!}</p>
        </div>
    @endif
</div>
