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
    <div class="hidden text-gray-800 lg:flex lg:flex-row lg:float-left lg:text-xs">
        <img class="rounded-full w-7 h-7 mx-2" src="{{ route('image.get', $user->propic) }}" alt='{{ $user->name }} profile picture' />
        <a class="my-auto underline" href="{{ route('userpage.show', $user->name) }}"> 
            {{ $user->name }} 
        </a>
    </div>
    <div class="hidden text-gray-800 lg:flex lg:flex-row lg:float-right lg:text-xs">
        <a class="my-auto hidden lg:block" href="{{ route('group.show', $group->name) }}" > 
            Posted in <span class="underline"> {{ $group->name }} </span> 
        </a>
        <img class="rounded-full w-7 h-7 mx-2 hidden lg:block" src="{{ route('image.get', $group->image_id) }}" alt='{{ $group->name }} profile picture' />
    </div>
    <div class="clear-both">
        <h2 class="w-full text-center mb-2"> 
            <a  class="underline" href="{{ route('post.show', $post->id) }}" > {{ $post->title }} </a> 
        </h2>
        <div class="flex flex-col">
            <p class="text-sm mx-auto lg:w-4/5"> {{ $post->content }} </p>
            @if($post->image_id)
                <div class="m-4 w-3/5 mx-auto">
                    <img class="max-w-full h-auto rounded-xl" src='{{ route('image.get', $post->image_id) }}' alt='image of {{ $post->title}}' />
                </div>
            @endif
        </div>
    </div>
    <p class="lg:text-sm text-xs mt-2"> 
        <a class="inline text-gray-800 underline lg:hidden" href="{{ route('userpage.show', $user->name) }}"> 
            By {{ $user->name }} 
        </a>
        <a class="inline text-gray-800 underline lg:hidden" href="{{ route('group.show', $group->name) }}"> 
            Posted in {{ $group->name }} 
        </a>
        <span class="inline text-gray-800 lg:hidden"> - </span> Comments: {{ $comment_count }} 
    </p>
</div>
