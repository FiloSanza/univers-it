@php
    /** @var $group 'App\Models\Group' */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $group->name }}
        </h2>
    </x-slot>

    <p> {{ $group->description }} </p>
</x-app-layout>
