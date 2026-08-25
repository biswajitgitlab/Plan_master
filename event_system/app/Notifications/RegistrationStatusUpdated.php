<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationStatusUpdated extends Notification
{
    use Queueable;

    public $registration;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(\App\Models\Registration $registration, string $message)
    {
        $this->registration = $registration;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Update regarding your event registration')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('There is an update on your registration for the event: ' . $this->registration->event->name)
                    ->line($this->message)
                    ->action('View Event', route('events.show', $this->registration->event_id))
                    ->line('Thank you for using our application!');
    }



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
}
