<div class="mt-4 p-4 border rounded-lg bg-gray-50">
    <h4 class="font-semibold mb-3">Update Ticket Status</h4>

    <form method="POST" action="{{ route('tickets.update', $ticket) }}">
        @csrf
        @method('PUT')

        <div class="flex items-end space-x-4">
            <div class="w-1/3">
                <label for="status" class="block text-sm font-medium text-gray-700">
                    New Status
                </label>

                <select name="status" class="mt-1 block w-full rounded-md">
                    <option value="New" {{ $ticket->status === 'New' ? 'selected' : '' }}>New</option>
                    <option value="In Progress" {{ $ticket->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                    Update Status
                </button>
            </div>
        </div>
    </form>
</div>
