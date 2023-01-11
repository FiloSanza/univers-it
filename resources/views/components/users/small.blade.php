@props([ 'user', 'already_followed' => null ])
<div class="flex flex-row items-center p-1 hover:bg-gray-200 hover:rounded-xl">
    <div class="flex flex-row w-2/3">
        <img src="{{ route('image.get', $user->propic) }}" class="w-12 rounded-full h-12 mx-2 my-2" alt="{{ $user->name }}" />
        <a href="{{ route('userpage.show', $user->name) }}" class="font-bold my-5"> 
            {{ $user->name }} 
        </a>
    </div>
    @unless(! (Auth::check() &&Auth::user()->hasVerifiedEmail()) || is_null($already_followed) || Auth::id() === $user->id)
        <div class="w-1/3 flex flex-row-reverse">
            <x-follow-button :userid="$user->id" :isfollowed="$already_followed" />
        </div>
    @endunless
</div>