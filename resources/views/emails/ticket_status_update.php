<p>Hello {{ $ticket->user->name }},</p>

<p>The status of your ticket has been updated.</p>

<p>
    <strong>Title:</strong> {{ $ticket->title }} <br>
    <strong>Status:</strong> {{ $ticket->status }}
</p>

<p>
    <a href="{{ route('tickets.show', $ticket) }}">View ticket</a>
</p>
