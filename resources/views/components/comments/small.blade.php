{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
        - Possibility to reply to the comment
--}}

<div class="my-1">
    <div id="{{ $id }}" class="p-3 bg-gray-100 rounded-xl target:bg-fuchsia-100">
        <div class="flex">
            <img src="{{ route('image.get', $user->propic) }}" class="w-7 h-7 rounded-full mx-2" />
            <a class="font-bold mx-2" href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a>
            @if($reply_to)
            <a class="p-1 text-center font-bold mx- bg-blue-100 rounded-xl ml-auto hover:bg-fuchsia-100" href="#{{ $reply_to }}">Previous</a>
            @endif
        </div>
        <div class="my-3">
            <a class="mx-4 my-4"> {{ $content }} </a> 
        </div>
        <p class="reply-span w-fit p-1 font-bold my-auto mx-4 bg-blue-100 rounded-xl hover:bg-fuchsia-100" data-target="comment-modal">Reply</p>
    </div>
</div>