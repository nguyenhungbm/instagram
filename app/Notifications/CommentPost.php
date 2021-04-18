<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;
class CommentPost extends Notification
{
    use Queueable;
    public $post,$user,$type;
    public function __construct(Post $post,User $user,$type)
    {
         $this->post=$post;
         $this->user=$user;
         $this->type=$type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
           'post'=> $this->post,
           'user'=> $this->user,
           'type'=> $this->type
        ];
    }
    public function toBroadCast($notifiable)
    {
        return [
           'data'=> [
               'post' =>$this->post,
               'user' =>$this->user,
               'type' =>$this->type

           ]
        ];
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
            //
        ];
    }
}
