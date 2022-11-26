@php
    /** @var $group '\App\Models\User' */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    @unless(Auth::id() == $user->id)
    @if($user->followers()->where(['users.id' => Auth::id()])->first())
    
    {{-- TODO: Use better js --}}
    <a href="{{ route('unfollow') }}" onclick="event.preventDefault(); document.getElementById('follow-form').submit();">
        Unfollow
    </a>

    {{-- TODO: Use better css --}}
    <form id="follow-form" action="{{ route('unfollow') }}" method="post" style="display: none;">
        @csrf
        <input type="hidden" name="followed_id" value="{{ $user->id }}" />
    </form>

    @else
    
    {{-- TODO: Use better js --}}
    <a href="{{ route('follow') }}" onclick="event.preventDefault(); document.getElementById('follow-form').submit();">
        Follow
    </a>
    
    {{-- TODO: Use better css --}}
    <form id="follow-form" action="{{ route('follow') }}" method="post" style="display: none;">
        @csrf
        <input type="hidden" name="followed_id" value="{{ $user->id }}" />
    </form>

    @endif
    @endunless
    
    <p> Followers: {{ count($user->followers()->get()) }} </p>
    <p> Follows: {{ count($user->follows()->get()) }} </p>

</x-app-layout>
