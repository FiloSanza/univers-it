@props([ 'group' ])

<a href="{{ route('group.show', $group->name) }}"> {{ $group->name }} </a>