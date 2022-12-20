<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFollowerNotification extends Notification
{
    use Queueable;

    /**
     * The recipient of the notification.
     * 
     * @var \App\Models\User
     */
    public $user;

    /**
     * The new follower of the notification.
     * 
     * @var \App\Models\User
     */
    public $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, User $follower)
    {
        $this->user = $user;
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('You have a new follower!')
                    ->greeting('Hi '.$this->user->name.'!')
                    ->line($this->follower->name.' started following you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => $this->user,
            'follower' => $this->follower
        ];
    }
}
