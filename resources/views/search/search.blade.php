{{-- 
    This is the template used to show the search results.
    The search results include:
        - users
        - posts
--}}

@php
    /** @var $results mixed */
    $users = $results['users'];
    $groups = $results['groups'];
    $list_lambda_user = function ($p) { 
        return ['user' => $p]; 
    };
    $list_lambda_group = function ($p) { 
        return ['group' => $p]; 
    };
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            SEARCH RESULTS
        </h2>
    </x-slot>

    <h3> GROUPS: </h3>
    <x-list.list itemtemplate='components.groups.small' :items="$groups->map($list_lambda_group)" />

    <br />

    <h3> USERS: </h3>
    <x-list.list itemtemplate='components.users.small' :items="$users->map($list_lambda_user)" />

</x-app-layout>
