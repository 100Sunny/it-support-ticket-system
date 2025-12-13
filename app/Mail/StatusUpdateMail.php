<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Mail\Mailable;

class StatusUpdateMail extends Mailable
{
    public Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('Ticket status updated')
            ->view('emails.ticket_status_updated')
            ->with([
                'ticket' => $this->ticket
            ]);
    }
}
