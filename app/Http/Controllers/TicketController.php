<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateMail;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->is_agent
            ? Ticket::latest()->get()
            : Auth::user()->tickets()->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Auth::user()->tickets()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'status'      => Ticket::STATUS_NEW,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['category', 'user', 'comments.user']);

        if (Auth::id() !== $ticket->user_id && !Auth::user()->is_agent) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        if (Auth::id() !== $ticket->user_id) {
            abort(403);
        }

        $categories = Category::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        // Agent updates status
        if ($user->is_agent && $request->has('status')) {

            $oldStatus = $ticket->status;

            $ticket->update([
                'status' => $request->status
            ]);
            
            //SEND EMAIL TO TICKET OWNER
            Mail::to($ticket->user->email)
                ->send(new StatusUpdateMail($ticket, $oldStatus));

            return redirect()
                ->route('tickets.show', $ticket)
                ->with('success', 'Ticket status updated and email sent.');
        }

        // Owner updates ticket
        if ($user->id !== $ticket->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        if (Auth::id() !== $ticket->user_id) {
            abort(403);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}
