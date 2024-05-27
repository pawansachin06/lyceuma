@if ($errors->any())
    <div {{ $attributes->merge(['class'=> 'px-3 py-2 rounded-md border border-solid border-red-200 bg-red-50']) }}>
        <p class="font-medium mb-1 text-red-600">{{ __('Whoops! Something went wrong.') }}</p>
        <ul class="text-sm pl-4 mb-0 text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
