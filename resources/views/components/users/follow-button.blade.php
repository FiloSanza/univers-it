@props([ 'userid', 'isfollowed' ])

@php
    $id = $isfollowed ? 'unfollow-form' : 'follow-form';
    $route = $isfollowed ? route('unfollow') : route('follow');
    $text = $isfollowed ? 'Unfollow' : 'Follow';
    $classes = $isfollowed ? 'bg-red-300 text-white rounded-xl px-10 py-0.5' : 'bg-blue-500 text-white rounded-xl px-10 py-0.5';
@endphp

<x-post-request-button 
    id='{{ $id }}'
    :route='$route'
    :parameters="[ 'followed_id' => $userid ]"
    class='{{ $classes }}' >
    {{ $text }}
</x-post-request-button>
