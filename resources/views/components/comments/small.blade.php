{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
        - Possibility to reply to the comment
--}}

<div class="my-1">
    <div id="{{ $id }}" class="p-3 bg-gray-100 rounded-xl target:bg-gra00">
        <div class="flex">
            <img src="{{ route('image.get', $user->propic) }}" class="w-7 h-7 rounded-full mx-2" />
            <a class="font-bold mx-2" href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a>
            @if($reply_to)
            <a class="p-1 w-20 text-center font-bold bg-blue-100 rounded-xl ml-auto hover:bg-blue-300" href="#{{ $reply_to }}">Previous</a>
            @endif
        </div>
        <div class="mt-2 flex">
            <a class="mx-4"> {{ $content }} </a> 
            <p class="reply-span w-20 ml-auto p-1 text-center font-bold bg-blue-100 rounded-xl hover:bg-blue-300" data-target="comment-modal">Reply</p>
        </div>
    </div>
</div>