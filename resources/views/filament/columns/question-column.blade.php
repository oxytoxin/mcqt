<div class="mt-4">
    <div>
        {!! $getState() !!}
    </div>
    <div class="mt-4">
        <p class="text-sm italic">Choices</p>
        <ul>
            @foreach ($getRecord()->choices as $choice)
                <li>
                    <x-heroicon-o-arrow-sm-right class="inline w-4" /> {!! $choice !!}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-4">
        <p class="text-sm italic">Answer</p>
        <p class="inline-block px-2 text-sm font-semibold text-green-700 bg-green-200 rounded-full">
            {!! $getRecord()->choices[$getRecord()->answer] ?? $getRecord()->answer !!}</p>
    </div>
    @if ($getRecord()->explanation)
        <div class="mt-4">
            <p class="text-sm italic">Explanation</p>
            <p class="mt-2 text-sm">{!! $getRecord()->explanation !!}</p>
        </div>
    @endif
</div>
