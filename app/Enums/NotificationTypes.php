<?php

namespace App\Enums;

enum NotificationTypes {
    case NEW_FOLLOWER;
    case NEW_COMMENT;
    case NEW_POST;
};