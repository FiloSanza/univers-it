{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
--}}

<div>
    <div class="lg:flex">
        <img src="{{ route('image.get', $user->propic) }}" class="w-10 h-10 rounded-full mx-2" />
        <a class="font-bold my-auto mx-1" href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }}: </a>
        <a class="my-auto"> {{ $content }} </a> 
    </div>
</div>
