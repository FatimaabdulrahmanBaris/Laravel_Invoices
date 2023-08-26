<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;

class Add_invoice extends Notification
{
    use Queueable;


    private $invoices_id;
    private $user_create;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(invoices $invoices_id,$user_create)
    {
        
        $this->invoices_id=$invoices_id;
        $this->user_create=$user_create;
       
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


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable){
        return [
            'id' =>$this->invoices_id->id,
            'title' =>'تم اضافة فاتورة بواسطة',
            'user' =>$this->user_create,
           
        ];
    }


}
