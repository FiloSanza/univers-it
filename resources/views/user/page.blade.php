@php
    /** @var $user '\App\Models\User' */
    $already_followed = $user->followers()->where(['users.id' => Auth::id()])->first();
    $followers = $user->followers()->get();
    $follows = $user->follows()->get();
    
    $list_lambda = function ($f) { return [ 'user' => $f ]; }
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
    
    <p> Followers: {{ count($followers) }} </p>
    <p> Follows: {{ count($follows) }} </p>
    
    <br>
    <h3> Followers </h3>
    <x-list.list itemtemplate='components.users.small' :items="$followers->map($list_lambda)" />
    
    <br>
    <h3> Follows </h3>
    <x-list.list itemtemplate='components.users.small' :items="$followers->map($list_lambda)" />

</x-app-layout>
