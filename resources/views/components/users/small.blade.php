@props([ 'user' ])

<a href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a>