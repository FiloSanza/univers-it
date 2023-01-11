@php
    /** @var $feed @mixed */
    $feed = Helper::sortByMostRecent($feed);
    $list_lambda = function ($p) { 
        return [ 'post' => $p, 'group' => $p->group()->first(), 'user' => $p->user()->first() ];
    };
@endphp

<x-app-layout>

    <x-slot name="script">
        @vite([
            'resources/js/popup.js',
            'resources/js/home.js', 
        ])
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <x-list.list itemtemplate='components.posts.small' :items="$feed->map($list_lambda)" />
            </div>
        </div>
    </div>

    @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
    <x-popup name="notverified-modal">
        <x-slot:header>
            ACCOUNT NOT VERIFIED
        </x-slot:header>
        <p>Thank you for signing up!</p>
        <p>Some functions are disabled until you verify the account.</p>
        <p>Check your emails!</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div class="flex flex-col items-center">
                <x-primary-button class="py-2 my-2">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>
   </x-popup>
    @endif

</x-app-layout>