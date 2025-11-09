@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-primary']) }}>
    {{ $value ?? $slot }}
</label>
