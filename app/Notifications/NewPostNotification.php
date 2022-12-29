<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
{
    use Queueable;

    /**
     * The user that gets notified.
     * 
     * @var \App\Models\User
     */
    public $notified_user;

    /**
     * The user that posted.
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
    public function __construct(User $notified_user, Post $post)
    {
        $this->user = $post->user()->first();
        $this->post = $post;
        $this->notified_user = $notified_user;
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
        $post_user = $this->user->name;
        
        return (new MailMessage)
                    ->subject($post_user.'has posted!')
                    ->greeting('Hi'.$this->notified_user->name.'!')
                    ->line($post_user.'has created a new post, check it out!')
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
