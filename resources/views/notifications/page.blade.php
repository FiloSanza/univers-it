<x-app-layout>
    <div class="border-b-2 border-gray-600 p-3">
        <div class="text-center">
            <h1 class="font-bold text-2xl">
                Notifications
            </h1>
        </div>
    </div>
    <div class="p-3 m-5 rounded-xl bg-slate-100">
        <div class="text-gray-800">
            <div class="flex">
                <img class="rounded-full w-8 h-8" src="{{ route('image.get', $user->propic) }}"/>
                <a class="my-auto underline mx-2" href="{{ route('userpage.show', $user->name) }}">
                    {{ $user->name }}
                </a>
                <p class="my-auto text-m"> ha iniziato a seguirti </p>
                <span class="ml-auto text-red-600 cursor-pointer float-right">
                    &times;
                </span>
            </div>
        </div>
    </div>
    <div class="p-3 m-5 rounded-xl bg-slate-100 text-gray-800 flex justify-between">  
        <img class="rounded-full w-8 h-8" src="{{ route('image.get', $user->propic) }}"/>
        <a class="my-auto underline mx-2" href="{{ route('userpage.show', $user->name) }}">
            {{ $user->name }}
        </a>
        <p class="my-auto text-m"> ha commentato il tuo post <a class="underline" href="{{ route('post.show', $post->id) }}"> {{ $post->title }} </a> : eskere </p>
        <span class="ml-auto text-red-600 cursor-pointer">
            &times;
        </span>
    </div>

    {{-- <x-list.list itemtemplate='components.notifications.small' :items='Auth::user()->unreadNotifications()->get()->map(function($n){ return ["notification" => $n]; })'/> --}}
</x-app-layout>