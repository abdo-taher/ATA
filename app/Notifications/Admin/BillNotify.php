<?php

namespace App\Notifications\Admin;

use App\Models\Admin\billModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BillNotify extends Notification
{
    use Queueable;
    private $bills ;

    /**
     * Create a new notification instance.
     */
    public function __construct(billModel $bill_id)
    {
        $this->bill_id = $bill_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        $url = 'ata.com/bills'.$this->bill_id;
//        return (new MailMessage)
//                    ->subject('اضافة فاتورة جديدة')
//                    ->line('اضافة فاتورة جديدة')
//                    ->action('عرض الفاتورة', $url)
//                    ->line('شكرا لاستخدامك شركة ATA للبرمجيات');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'id' => $this->bill_id->id,
            'title' => 'تم اضافة الفاتورة بواسطة : ',
            'user' => auth()->user()->name,

        ];
    }

}
