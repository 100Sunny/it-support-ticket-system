<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCommentMail;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        // ✅ Validación correcta
        $request->validate([
            'body' => 'required|string'
        ]);

        // ✅ Crear comentario
        $ticket->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        // ✅ Enviar email al creador del ticket
        Mail::to($ticket->user->email)->send(
            new NewCommentMail($ticket)
        );

        return back()->with('success', 'Comment added successfully');
    }
}
