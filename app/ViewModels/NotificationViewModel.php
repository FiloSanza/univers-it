<?php

namespace App\ViewModels;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewFollowerNotification;
use Illuminate\Notifications\Notification;
use App\Enum\NotificationTypes;
use App\Enum\NotificationFieldTypes;

class NotificationViewModel
{
    /**
     * The original notification.
     * 
     * @var Notification
     */
    public Notification $notification;

    /**
     * The notification serialized as an array.
     * 
     * @var array
     */
    public array $serializedNotification;

    /**
     * Construct a new object.
     * 
     * @param Notification $notification.
     */
    public function __construct(Notification $notification) {
        $this->notification = $notification;
        $this->serialize($notification);
    }

    private function serialize(Notification $notification) {
        dd($notification->type);

        $this->serializedNotification = [];

        switch ($notification->type) {
            case NewFollowerNotification::class:
                $this->serializeNewFollowerNotification($notification);
                break;
            case NewCommentNotification::class:
                $this->serializeNewCommentNotification($notification);
                break;
        }
    }

    private function addSerializedEntry(NotificationFieldTypes $type, mixed $value) {
        $this->serializedNotification[] = [
            'type' => $type,
            'value' => $value
        ];
    }

    private function serializeNewFollowerNotification(NewFollowerNotification $notification) {
        $this->addSerializedEntry(NotificationFieldTypes::TYPE, NotificationTypes::NEW_FOLLOWER);
        $this->addSerializedEntry(NotificationFieldTypes::USER_LINK, $notification->follower);
    }

    private function serializeNewCommentNotification(NewCommentNotification $notification) {
        $comment = $notification->comment;
        $post = $notification->comment->post()->first();
        $user = $notification->comment->user()->first();

        $this->addSerializedEntry(NotificationFieldTypes::TYPE, NotificationTypes::NEW_COMMENT);
        $this->addSerializedEntry(NotificationFieldTypes::USER_LINK, $user);
        $this->addSerializedEntry(NotificationFieldTypes::POST_LINK, $post);
        $this->addSerializedEntry(NotificationFieldTypes::COMMENT_LINK, $comment);
    }
}
