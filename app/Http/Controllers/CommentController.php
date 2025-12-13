<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        abort_if(!auth()->user()->is_agent, 403);

        Comment::create([
            'body' => $request->body,
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}
