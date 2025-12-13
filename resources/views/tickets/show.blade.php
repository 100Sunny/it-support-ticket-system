<x-app-layout>
    <h1>{{ $ticket->title }}</h1>

    <p>{{ $ticket->description }}</p>
    <p>Status: {{ $ticket->status }}</p>

    <hr>

    <h3>Comments</h3>

    @foreach ($ticket->comments as $comment)
        <p>{{ $comment->content }}</p>
    @endforeach

    <hr>

    <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}">
        @csrf
        <textarea name="content" required></textarea>
        <button type="submit">Add Comment</button>
    </form>
</x-app-layout>
