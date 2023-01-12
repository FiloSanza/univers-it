@props([ 'notification' ])

<div class="p-3 m-5 rounded-xl bg-slate-100 relative">
    <div class="text-gray-800">
        <div class="w-full flex flex-col sm:flex-row">
            <div class="flex flex-col {{ $notification->read ? '' : 'sm:w-[90%]' }}">
                @switch($notification->type)
                    @case(NotificationTypes::NEW_FOLLOWER)
                        <div class="w-full flex flex-col">
                            <div class="flex flex-row">
                                <img class="rounded-full w-8 h-8" src="{{ route('image.get', $notification->user->propic) }}"/>
                                <a class="my-auto underline mx-2" href="{{ route('userpage.show', $notification->user->name) }}">
                                    {{ $notification->user->name }}
                                </a>
                            </div>
                            <p class="my-auto text-m"> Started following you. </p>
                        </div>
                    @break
                    @case(NotificationTypes::NEW_COMMENT)
                        <div class="w-full flex flex-col sm:flex-row">
                            <div class="flex flex-row">
                                <img class="rounded-full w-8 h-8" src="{{ route('image.get', $notification->user->propic) }}"/>
                                <a class="my-auto underline mx-2" href="{{ route('userpage.show', $notification->user->name) }}">
                                    {{ $notification->user->name }}
                                </a>
                            </div>
                            <p class="my-auto text-m"> Commented under your post <a href="{{ route('post.show', $notification->post->id) }}" class="underline"> {{ $notification->post->title }}</a>: </p>
                        </div>
                        <p class="m-5 break-words"> {{ $notification->comment->content }} </p>
                    @break
                    @case(NotificationTypes::NEW_POST)
                        <div class="w-full flex flex-col">
                            <div class="flex flex-row">
                                <img class="rounded-full w-8 h-8" src="{{ route('image.get', $notification->user->propic) }}"/>
                                <a class="my-auto underline mx-2" href="{{ route('userpage.show', $notification->user->name) }}">
                                    {{ $notification->user->name }}
                                </a>
                            </div>
                            <p class="my-auto text-m"> Has posted <a class="underline" href="{{ route('post.show', $notification->post->id) }}">{{$notification->post->title}}</a>. </p>
                        </div>
                    @break
                    @case(NotificationTypes::NEW_REACTION)
                        <div class="w-full flex flex-col">
                            <div class="flex flex-row">
                                <img class="rounded-full w-8 h-8" src="{{ route('image.get', $notification->user->propic) }}"/>
                                <a class="my-auto underline mx-2" href="{{ route('userpage.show', $notification->user->name) }}">
                                    {{ $notification->user->name }}
                                </a>
                            </div>
                            <p class="my-auto text-m"> Reacted to <a class="underline" href="{{ route('post.show', $notification->post->id) }}">{{$notification->post->title}}</a>. </p>
                        </div>
                    @break
                @endswitch
            </div>
            @unless ($notification->read)
                <div class="w-full mx-auto mt-2 flex sm:w-[10%] sm:my-auto">
                    <span class="mx-auto text-red-600 cursor-pointer" data-notification-target="{{ $notification->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>                      
                    </span>
                </div>
            @endunless
        </div>
    </div>
</div>