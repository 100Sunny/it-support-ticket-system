<div class="mt-6 pt-6 border-t border-gray-200">
    <h4 class="text-xl font-semibold mb-4">Add Comment</h4>

    <form method="POST" action="{{ route('comments.store', $ticket) }}">
        @csrf

        <div class="mb-4">
            <textarea name="content"
                        rows="3"
                        class="w-full border rounded p-2"
                        placeholder="Write your response..."
                        required></textarea>

        </div>

        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
            Submit Comment
        </button>
    </form>
</div>
