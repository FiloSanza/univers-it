@props([ 'userid' => null, 'groupid' => null, 'isfollowed' ])

@php
    $id = $isfollowed ? 'unfollow-form' : 'follow-form';
    $route = $userid 
        ? ($isfollowed ? route('user.unfollow') : route('user.follow'))
        : ($isfollowed ? route('group.unfollow') : route('group.follow'));
    $text = $isfollowed ? 'Unfollow' : 'Follow';
    $classes = $isfollowed
        ? "bg-red-500 text-white rounded-xl px-10 py-0.5 hover:bg-white hover:text-red-500 hover:border-2 hover:border-red-500"
        : "bg-blue-500 text-white rounded-xl px-10 py-0.5 hover:bg-white hover:text-blue-500 hover:border-2 hover:border-blue-500";
@endphp

<x-post-request-button 
    id='{{ $id }}'
    :route='$route'
    :parameters="$groupid ? ([ 'group_id' => $groupid ]) : ([ 'followed_id' => $userid ])"
    :class='$classes' >
    {{ $text }}
</x-post-request-button>
