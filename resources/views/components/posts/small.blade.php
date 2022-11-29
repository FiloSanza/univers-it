{{-- 
    This is the template used to show a small version of the post.
    This page will show:
        - Title
        - Group (if set)
        - User (if set)
        - Comment count
--}}
@props([ 'post', 'group' => null, 'user' => null ])

@php($comment_count = $post->comments()->count())

<div>
    <h2> <a href="{{ route('post.show', $post->id) }}"> {{ $post->title }} </a> </h2> 
    <small> Comments: {{ $comment_count }} </small>
    @if($group)
        <small><a href="{{ route('group.show', $group->name) }}"> - Posted in {{ $group->name }} </a></small>
    @endif
    @if($user)
        <small><a href="{{ route('userpage.show', $user->name) }}"> By {{ $user->name }} </a></small>
    @endif
</div>
