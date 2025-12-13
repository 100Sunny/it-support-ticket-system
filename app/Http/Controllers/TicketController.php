public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id'
    ]);

    Ticket::create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => Ticket::STATUS_NEW, // ✅ ahora funciona
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('tickets.index');
}
