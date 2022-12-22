<?php

namespace App\Enum;

enum NotificationFieldTypes 
{
    case TYPE;
    case USER_LINK;
    case POST_LINK;
    case COMMENT_LINK;
};