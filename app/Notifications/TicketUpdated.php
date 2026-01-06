<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public Ticket $ticket;
    public string $message;

    public function __construct(Ticket $ticket, string $message)
    {
        $this->ticket  = $ticket;
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Updated: '.$this->ticket->subject)
            ->greeting('Hello '.$notifiable->name.',')
            ->line($this->message)
            ->line('**Ticket Subject:** '.$this->ticket->subject)
            ->line('**Current Status:** '.$this->ticket->status)
            ->action('View Ticket', url('/user/tickets/'.$this->ticket->id))
            ->line('Thank you for using our support portal!');
    }
}
