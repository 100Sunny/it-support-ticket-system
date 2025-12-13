<x-app-layout>
    <h1>Create Ticket</h1>

    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        <input type="text" name="title" placeholder="Title" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <button type="submit">Create</button>
    </form>
</x-app-layout>
