<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCommentMail;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        // SECURITY: only agents can comment
        if (!Auth::user()->is_agent) {
            abort(403, 'Only support agents can add comments.');
        }

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $ticket->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);


        // Notify ticket owner
        Mail::to($ticket->user)->send(
            new NewCommentMail($ticket, $comment)
        );

        return back()->with('success', 'Comment added successfully.');
    }
}
