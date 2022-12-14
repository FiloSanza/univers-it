@props([ 'user', 'already_followed' ])
<div class="flex flex-row items-center">
    <div class="flex flex-row w-2/3">
        <img src="{{ route('image.get', $user->propic) }}" class="w-12 rounded-full h-12 mx-2 my-2">
        <a href="{{ route('userpage.show', $user->name) }}" class="font-bold my-5"> 
            {{ $user->name }} 
        </a>
    </div>
    <div class="w-1/3 flex flex-row-reverse">
        <x-follow-button :userid="$user->id" :isfollowed="$already_followed" />
    </div>
</div>