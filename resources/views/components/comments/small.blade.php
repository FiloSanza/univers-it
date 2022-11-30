{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
--}}

<div>
    @if($user)
        <small><a href="{{ route('userpage.show', $user) }}"> {{ $user->name }}: </a></small>
    @endif
    @if($content)
        <small> {{ $content }} </a></small>
    @endif
</div>
