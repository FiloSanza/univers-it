<?php

namespace App\Notifications;

use App\Models\Comment;
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
    public $notified_user;

    /**
     * The new comment.
     * 
     * @var \App\Models\Comment
     */
    public $comment;

    /**
     * The user that created the comment.
     * 
     * @var \App\Models\User 
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $notified_user, Comment $comment)
    {
        $this->notified_user = $notified_user;
        $this->comment = $comment;
        $this->user = $comment->user()->first();
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
        $mail_settings = $this->notified_user->mailSettings()->first();
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
            ->greeting('Hi '.$this->notified_user->name.'!')
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
            'notified_user' => $this->notified_user,
            'user' => $this->user,
            'post' => $this->comment->post()->first(),
            'comment' => $this->comment,
        ];
    }
}
