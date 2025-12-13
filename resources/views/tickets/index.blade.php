<x-app-layout>
    <h1>My Tickets</h1>

    <a href="{{ route('tickets.create') }}">Create Ticket</a>

    <ul>
        @foreach ($tickets as $ticket)
            <li>
                <a href="{{ route('tickets.show', $ticket) }}">
                    {{ $ticket->title }} - {{ $ticket->status }}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
