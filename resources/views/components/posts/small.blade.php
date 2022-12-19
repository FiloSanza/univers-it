{{-- 
    This is the template used to show a small version of the post.
    This page will show:
        - Title
        - Group
        - User
        - Comment count
--}}
@props([ 'post', 'group', 'user' ])

@php($comment_count = $post->comments()->count())

<div class="p-3 m-5 rounded-xl bg-slate-100">
    <div class="hidden lg:flex lg:flex-row lg:float-left lg:text-xs">
        <img class="rounded-full w-7 h-7 mx-2" src="{{ route('image.get', $user->propic) }}" />
        <a class="my-auto" href="{{ route('userpage.show', $user->name) }}"> 
            {{ $user->name }} 
        </a>
    </div>
    <div class="hidden lg:flex lg:flex-row lg:float-right lg:text-xs">
        <a class="my-auto hidden lg:block" href="{{ route('group.show', $group->name) }}"> 
            Posted in {{ $group->name }} 
        </a>
        <img class="rounded-full w-7 h-7 mx-2 hidden lg:block" src="{{ route('image.get', $group->image_id) }}" />
    </div>
    <div class="clear-both">
        <h2 class="w-full text-center mb-2 underline"> 
            <a href="{{ route('post.show', $post->id) }}"> {{ $post->title }} </a> 
        </h2> 
        <p class="text-sm mx-auto lg:w-4/5"> {{ $post->content }} </p>
    </div>
    <p class="lg:text-sm text-xs mt-2"> 
        <a class="lg:hidden inline" href="{{ route('userpage.show', $user->name) }}"> 
            By {{ $user->name }} 
        </a>
        <a class="lg:hidden inline" href="{{ route('group.show', $group->name) }}"> 
            Posted in {{ $group->name }} 
        </a>
        <span class="lg:hidden inline"> - </span> Comments: {{ $comment_count }} 
    </p>
</div>
