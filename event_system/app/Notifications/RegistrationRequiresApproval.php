<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationRequiresApproval extends Notification
{
    use Queueable;

    public $registration;

    /**
     * Create a new notification instance.
     */
    public function __construct(\App\Models\Registration $registration)
    {
        $this->registration = $registration;
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
                    ->subject('New Registration Requires Your Approval')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('A new registration for the event "' . $this->registration->event->name . '" requires your approval.')
                    ->line('Applicant: ' . $this->registration->user->name)
                    ->action('Review Registration', route('approvals.index'))
                    ->line('Please review and process this registration promptly.');
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
