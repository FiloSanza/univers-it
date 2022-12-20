{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
        - Possibility to reply to the comment
--}}

<div>
    <div id="{{ $id }}" class="flex p-3 bg-gray-100 rounded-xl target:bg-fuchsia-100">
        <img src="{{ route('image.get', $user->propic) }}" class="w-10 h-10 rounded-full mx-2" />
        <a class="font-bold my-auto mx-1" href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }}: </a>
        <a class="my-auto"> {{ $content }} </a> 
        @if($reply_to)
        <a class="p-1 text-center font-bold my-auto mx-1 bg-blue-100 rounded-xl ml-auto" href="#{{ $reply_to }}">Previous Comment</a>
        @endif
        <span class="reply-span p-1 font-bold my-auto mx-1 bg-blue-100 rounded-xl ml-auto" data-target="comment-modal">Reply</span>
    </div>
</div>