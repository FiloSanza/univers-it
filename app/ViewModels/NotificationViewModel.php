<?php

namespace App\ViewModels;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewFollowerNotification;
use App\Notifications\NewPostNotification;
use Illuminate\Notifications\DatabaseNotification;
use App\Enums\NotificationTypes;

class NotificationViewModel
{
    /**
     * The original notification.
     * 
     * @var DatabaseNotification
     */
    public DatabaseNotification $notification;

    /**
     * The id of the notification.
     * 
     * @var string
     */
    public string $id;

    /**
     * Whether the notification has been read or not.
     * 
     * @var bool
     */
    public bool $read;

    /**
     * Type of the notification
     * 
     * @var \App\Enum\NotificationTypes
     */
    public NotificationTypes $type;

    /**
     * The user that will be showed in the notification.
     * @var object
     */
    public ?object $user;

    /**
     * The comment that will be showed in the notification.
     * @var object
     */
    public ?object $comment;

    /**
     * The post that will be showed in the notification.
     * @var object
     */
    public ?object $post;

    /**
     * Construct a new object.
     * 
     * @param DatabaseNotification $notification.
     */
    public function __construct(DatabaseNotification $notification) {
        $this->notification = $notification;
        $this->deserialize($notification);
    }

    private function deserialize(DatabaseNotification $notification) {
        $this->id = $notification->id;
        $this->read = !is_null($notification->read_at);
        switch ($notification->type) {
            case NewFollowerNotification::class:
                $this->deserializeNewFollowerNotification($notification);
                break;
            case NewCommentNotification::class:
                $this->deserializeNewCommentNotification($notification);
                break;
            case NewPostNotification::class:
                $this->deserializeNewPostNotification($notification);
                break;
        }
    }

    private function deserializeNewFollowerNotification(DatabaseNotification $notification) {
        $follower = (object)$notification->data["follower"];
        $this->type = NotificationTypes::NEW_FOLLOWER;
        $this->user = $follower;
    }

    private function deserializeNewCommentNotification(DatabaseNotification $notification) {
        $this->type = NotificationTypes::NEW_COMMENT;
        $this->comment = (object)$notification->data["comment"];
        $this->post = (object)$notification->data["post"];
        $this->user = (object)$notification->data["user"];
    }

    private function deserializeNewPostNotification(DatabaseNotification $notification) {
        $this->type = NotificationTypes::NEW_POST;
        $this->post = (object)$notification->data["post"];
        $this->user = (object)$notification->data["user"];
    }
}
