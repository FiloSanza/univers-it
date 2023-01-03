<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Mail settings</h2>
        <p class="mt-1 text-sm text-gray-600">Tick the notifications you want to get emails for.</p>
    </header>

    <div class="p-1 items-center">
        <input type="checkbox" id="new-post" name="new-post" data-target="new-post-mail" class="m-1" />
        <x-input-label for="new-post" class="inline-block m-1">
            New post notifications.
        </x-input-label>
    </div>
    <div class="p-1 items-center">
        <input type="checkbox" id="new-follower" name="new-follower" data-target="new-follower-mail" class="m-1" />
        <x-input-label for="new-follower" class="inline-block m-1">
            New follower notifications.
        </x-input-label>
    </div>
    <div class="p-1 items-center">
        <input type="checkbox" id="new-comment" name="new-comment" data-target="new-comment-mail" class="m-1" />
        <x-input-label for="new-comment" class="inline-block m-1">
            New comment notifications.
        </x-input-label>
    </div>
    <div class="p-1 items-center">
        <input type="checkbox" id="new-reaction" name="new-reaction" data-target="new-reaction-mail" class="m-1" />
        <x-input-label for="new-reaction" class="inline-block m-1">
            New reaction notifications.
        </x-input-label>
    </div>

</section>