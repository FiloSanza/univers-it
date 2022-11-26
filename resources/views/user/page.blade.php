@php
    /** @var $group '\App\Models\User' */
    $already_followed = $user->followers()->where(['users.id' => Auth::id()])->first();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    @unless(Auth::id() == $user->id)
        <x-users.follow-button :userid="$user->id" :isfollowed="$already_followed" />
    @endunless
    
    <p> Followers: {{ count($user->followers()->get()) }} </p>
    <p> Follows: {{ count($user->follows()->get()) }} </p>

</x-app-layout>
