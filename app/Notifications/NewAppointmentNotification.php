<?php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentNotification extends Notification
{
    use Queueable;

    public Meeting $meeting;

    /**
     * Create a new notification instance.
     */
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; 
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $studentName = $this->meeting->student->name;
        $appointmentTime = $this->meeting->meeting_time->format('l, d F Y \p\u\k\u\l H:i');
        $viewUrl = url('/appointment/'.$this->meeting->id.'/show');


        return (new MailMessage)
            ->subject('Permintaan Janji Temu Baru')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line("Anda telah menerima permintaan janji temu baru dari mahasiswa **{$studentName}**.")
            ->line("Jadwal yang diajukan adalah pada: **{$appointmentTime}**.")
            ->action('Tinjau Permintaan Sekarang', $viewUrl);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'sender_name' => $this->meeting->student->name,
            'sender_photo_url' => $this->meeting->student->profile_photo_path,
            'message' => "Permintaan appointment dari {$this->meeting->student->name}",
            'url' => url('/appointment/'.$this->meeting->id.'/show'),
            'meeting_id' => $this->meeting->id,
        ];
    }
}
