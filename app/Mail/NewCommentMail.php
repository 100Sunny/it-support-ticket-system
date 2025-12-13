<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;
    public Comment $comment;

    public function __construct(Ticket $ticket, Comment $comment)
    {
        $this->ticket = $ticket;
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->subject('New Comment on Your Ticket')
            ->view('emails.new_comment');
    }
}
