<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReactionNotification extends Notification
{
    use Queueable;

    /**
     * The user that gets notified.
     * 
     * @var \App\Models\User
     */
    public $notified_user;

    /**
     * The user that reacted.
     * 
     * @var \App\Models\User
     */
    public $user;

    /**
     * The new post.
     * 
     * @var \App\Models\Post
     */
    public $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->notified_user = $post->user()->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = ['database'];
        $user = $this->notified_user;
        $mail_settings = $user->mailSettings()->first();
        if ($mail_settings->new_reaction) {
            $channels[] = 'mail';
        }
        return $channels;
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
            ->subject($this->user->name.' reacted to '.$this->post->title.'!')
            ->greeting('Hi '.$this->notified_user->name.'!')
            ->line($this->post->title.' has a new reaction from '.$this->user->name)
            ->action('Go to the post!', url('/post', $this->post->id));
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
            'notified_user' => $this->notified_user,
            'user' => $this->user,
            'post' => $this->post
        ];
    }
}
