@props([ 'userlist' ])

<ul>
    @each('components.users.list-item', $userlist, 'user', 'components.users.empty-list-message')
</ul>