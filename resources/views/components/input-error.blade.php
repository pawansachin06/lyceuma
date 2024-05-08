@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'mb-0 text-sm text-red-600']) }}>{{ $message }}</p>
@enderror
