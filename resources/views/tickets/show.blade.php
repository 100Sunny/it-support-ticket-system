<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket #{{ $ticket->id }} - {{ $ticket->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Ticket info --}}
            <div class="bg-white shadow rounded p-6 mb-6">
                <h3 class="text-2xl font-bold mb-2">{{ $ticket->title }}</h3>
                <p class="mb-4">{{ $ticket->description }}</p>

                <p><strong>Category:</strong> {{ $ticket->category->name }}</p>
                <p><strong>Status:</strong> {{ $ticket->status }}</p>
                <p><strong>Created by:</strong> {{ $ticket->user->name }}</p>
            </div>

            {{-- EDIT / DELETE (ONLY OWNER + NEW) --}}
            @if(auth()->id() === $ticket->user_id && $ticket->status === 'New')
                <div class="mb-6">
                    <a href="{{ route('tickets.edit', $ticket) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                        Edit Ticket
                    </a>

                    <form action="{{ route('tickets.destroy', $ticket) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded"
                                onclick="return confirm('Are you sure?')">
                            Delete Ticket
                        </button>
                    </form>
                </div>
            @endif

            {{-- STATUS UPDATE (AGENT ONLY) --}}
            @if(auth()->user()->is_agent)
                @include('tickets.status_update')
            @endif

            {{-- COMMENTS --}}
            <div class="bg-white shadow rounded p-6 mt-6">
                <h4 class="text-xl font-semibold mb-4">Comments</h4>

                @forelse($ticket->comments as $comment)
                    <div class="border-b py-2">
                        <strong>{{ $comment->user->name }}</strong>:
                        {{ $comment->body }}
                    </div>
                @empty
                    <p>No comments yet.</p>
                @endforelse

                @if(auth()->user()->is_agent)
                    @include('tickets.new_comment')
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
