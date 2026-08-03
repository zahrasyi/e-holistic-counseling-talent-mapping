<?php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmedNotification extends Notification
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
        $counselorName = $this->meeting->counselor->name;
        $appointmentTime = $this->meeting->meeting_time->format('l, d F Y \p\u\k\u\l H:i');
        $viewUrl = route('appointments.riwayatMahasiswa');

        return (new MailMessage)
            ->subject('Janji Temu Anda Telah Dikonfirmasi!')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line("Kabar baik! Janji temu Anda dengan konselor **{$counselorName}** telah dikonfirmasi.")
            ->line("Jadwal yang telah disetujui adalah pada: **{$appointmentTime}**.")
            ->action('Lihat Riwayat Janji Temu', $viewUrl)
            ->line('Mohon hadir tepat waktu. Terima kasih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'sender_name' => $this->meeting->counselor->name,
            'sender_photo_url' => optional($this->meeting->counselor->counselor)->profile_photo_path,
            'message' => "Janji temu anda telah di {$this->meeting->status}",
            'url' => route('appointments.approvedPasien'),
            'meeting_id' => $this->meeting->id
        ];
    }
}
