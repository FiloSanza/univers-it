@php
    /** @var $feed @mixed */
    $feed = Helper::sortByMostRecent($feed);
    $list_lambda = function ($p) { 
        return [ 'post' => $p, 'group' => $p->group()->first(), 'user' => $p->user()->first() ];
    };
@endphp

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <x-list.list itemtemplate='components.posts.small' :items="$feed->map($list_lambda)" />
            </div>
        </div>
    </div>
</x-app-layout>