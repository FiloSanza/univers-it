@php
    /** @var $post '\App\Models\Post' */
@endphp

<x-app-layout>
    @if($post)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <p> {{ $post->content }} </p>
    @endif
</x-app-layout>
