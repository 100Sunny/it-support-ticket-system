<x-app-layout>
    <h1>Edit Ticket</h1>

    <form method="POST" action="{{ route('tickets.update', $ticket) }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $ticket->title }}" required>

        <textarea name="description" required>{{ $ticket->description }}</textarea>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
