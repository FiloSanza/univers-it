<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    /**
     * The user that has to be notified.
     * 
     * @var \App\Models\User
     */
    public $user;

    /**
     * The new comment.
     * 
     * @var \App\Models\Comment
     */
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
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
        $post = $this->comment->post()->first();
        $user = $post->user()->first();
        $mail_settings = $user->mailSettings()->first();
        if ($mail_settings->new_comment) {
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
        $comment_user = $this->comment->user()->first()->name;
        $post = $this->comment->post()->first();

        return (new MailMessage)
            ->subject('Your post has a new comment!')
            ->greeting('Hi '.$this->user->name.'!')
            ->line($comment_user.' posted a comment under your '.$post->title.' post!')
            ->action('Go to the post!', url('/post', $post->id));
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
            'post' => $this->comment->post()->first(),
            'comment' => $this->comment,
        ];
    }
}
