@props([ 'userid' => null, 'groupid' => null, 'isfollowed', 'ismainbutton' => false ])

@php
    $id = $groupid ?: $userid; 
    $text = $isfollowed ? 'Unfollow' : 'Follow';
    $classes = $isfollowed
        ? "cursor-pointer bg-red-500 text-white rounded-xl px-8 py-0.5 border-2 border-red-500 hover:bg-red-100 hover:text-red-500"
        : "cursor-pointer bg-blue-500 text-white rounded-xl px-10 py-0.5 border-2 border-blue-500 hover:bg-blue-100 hover:text-blue-500";
@endphp

<div class="follow-button">
    <span 
        class="{{$classes}}" 
        data-follow-id="{{ $id }}" 
        data-follow-type="{{$groupid ? 'group' : 'user'}}"
        @if($ismainbutton)
            data-follow-main
        @endif
    >
        {{ $text }}
    </span>
</div>
