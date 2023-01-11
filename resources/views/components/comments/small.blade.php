{{-- 
    This is the template used to show a small version of the comment.
    This page will show:
        - User
        - Content
        - Possibility to reply to the comment
--}}

<div class="my-1">
    <div id="{{ $id }}" class="flex flex-col p-3 bg-gray-100 rounded-xl sm:flex-row target:bg-gray-300">
        <div class="flex flex-col w-[85%]">
            <div class="flex flew-col">
                <div class="flex flex-row items-center">
                    <img src="{{ route('image.get', $user->propic) }}" class="w-7 h-7 rounded-full mr-2" />
                    <a class="font-bold mx-2" href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a>
                </div>
            </div>
            <p class="break-words w-full"> {{ $content }} </p> 
        </div>
        <div class="mt-2 w-full flex flex-row sm:flex-col sm:w-[15%] sm:max-w-20">
            @if($reply_to)
                <a class="p-1 w-1/2 m-1 text-center font-bold bg-blue-100 rounded-xl hover:bg-gray-300 sm:w-full sm:mx-auto" href="#{{ $reply_to }}">Previous</a>
            @endif
            @auth
                <p class="reply-p my-auto mx-auto m-1 p-1 w-1/2 text-center font-bold bg-blue-100 rounded-xl hover:bg-gray-300 sm:w-full" data-target="comment-modal">Reply</p>
            @endauth
        </div>
    </div>
</div>