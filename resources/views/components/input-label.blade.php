@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-2 block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
