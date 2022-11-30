{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
--}}

<div>
    <small><a href="{{ route('userpage.show', $user) }}"> {{ $user->name }}: </a></small>
    <small> {{ $content }} </a></small>
</div>
