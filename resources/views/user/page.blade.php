@php
    /** @var $group '\App\Models\User' */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <p> Followers: {{ count($user->followers()->get()) }} </p>
    <p> Follows: {{ count($user->follows()->get()) }} </p>

</x-app-layout>
