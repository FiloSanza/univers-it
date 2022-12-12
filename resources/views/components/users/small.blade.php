@props([ 'user' ])
<div class="flex flex-row">
    <img src="{{ route('image.get', $user->propic) }}" class="w-12 rounded-full h-12 mx-2 my-2">
    <a href="{{ route('userpage.show', $user->name) }}" class="font-bold my-5"> 
        {{ $user->name }} 
    </a>
</div>