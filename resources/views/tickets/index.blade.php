<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Support Tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Ticket List</h3>

                    <a href="{{ route('tickets.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create Ticket
                    </a>
                </div>

                @if($tickets->isEmpty())
                    <p class="text-gray-600">You have no tickets yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $ticket->title }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $ticket->category->name }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                @if($ticket->status === 'New') bg-red-100 text-red-800
                                                @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ $ticket->status }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $ticket->created_at->diffForHumans() }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-right">
                                            <a href="{{ route('tickets.show', $ticket) }}"
                                               class="text-blue-600 hover:text-blue-900 mr-3">
                                                View
                                            </a>

                                            @if(auth()->id() === $ticket->user_id)
                                                <a href="{{ route('tickets.edit', $ticket) }}"
                                                   class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                    Edit
                                                </a>

                                                <form action="{{ route('tickets.destroy', $ticket) }}"
                                                      method="POST"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
