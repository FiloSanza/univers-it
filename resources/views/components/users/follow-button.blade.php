@props([ 'userid', 'isfollowed' ])

<div>
    @if($isfollowed)
        <x-post-request-button id='unfollow-form' :route="route('unfollow')" :parameters="[ 'followed_id' => $userid ]">
            Unfollow
        </x-post-request-button>
    @else
        <x-post-request-button id='follow-form' :route="route('follow')" :parameters="[ 'followed_id' => $userid ]">
            Follow
        </x-post-request-button>
    @endif
</div>