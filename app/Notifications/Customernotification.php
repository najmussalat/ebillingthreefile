<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Customernotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data=$data;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }
  
  
    public function toDatabase($notifiable)
    {
        return [
           'data' => $this->data['customerdata']
        ];
    }
}
