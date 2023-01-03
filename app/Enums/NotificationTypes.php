<?php

namespace App\Enums;

enum NotificationTypes: string {
    case NEW_REACTION = "new_reaction";
    case NEW_FOLLOWER = "new_follower";
    case NEW_COMMENT = "new_comment";
    case NEW_POST = "new_post";
};