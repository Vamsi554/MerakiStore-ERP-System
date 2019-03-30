<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserTasks extends Notification
{
    use Queueable;
    public $priority;
    public $data;
    public $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($priority, $data, $link)
    {
        $this->priority = $priority;
        $this->data = $data;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
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
            'priority' => $this->priority,
            'data' => $this->data,
            'link' => $this->link
        ];
    }
}
