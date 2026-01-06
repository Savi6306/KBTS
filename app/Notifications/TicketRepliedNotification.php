<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketRepliedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Ticket $ticket;
    public TicketReply $reply;

    public function __construct(Ticket $ticket, TicketReply $reply)
    {
        $this->ticket = $ticket;
        $this->reply  = $reply;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Reply on Your Ticket: '.$this->ticket->subject)
            ->view('mail.agent_reply', [
                'ticket'     => $this->ticket,
                'reply'      => $this->reply,
                'notifiable' => $notifiable
            ]);
    }
}
