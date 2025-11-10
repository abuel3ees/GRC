<table class="min-w-full text-sm border border-border/60 rounded-lg overflow-hidden">
    <thead class="bg-muted/40 text-muted-foreground">
        <tr>
            <th class="px-4 py-2 text-left">Code</th>
            <th class="px-4 py-2 text-left">Title</th>
            <th class="px-4 py-2 text-left">Score</th>
            <th class="px-4 py-2 text-left">Residual Level</th>
            <th class="px-4 py-2 text-left">Likelihood</th>
            <th class="px-4 py-2 text-left">Impact</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border/60">
        @forelse($risks as $risk)
            <tr class="hover:bg-muted/30 transition">
                <td class="px-4 py-2">{{ $risk->code }}</td>
                <td class="px-4 py-2">{{ $risk->title }}</td>
                <td class="px-4 py-2 font-semibold">{{ $risk->score }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded-md
                        {{ $risk->residual_level === 'High' ? 'bg-red-500/20 text-red-400' :
                           ($risk->residual_level === 'Medium' ? 'bg-yellow-500/20 text-yellow-400' :
                           'bg-green-500/20 text-green-400') }}">
                        {{ $risk->residual_level }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $risk->likelihood }}</td>
                <td class="px-4 py-2">{{ $risk->impact }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.cyberrisks.edit', $risk->id) }}"
                       class="text-blue-400 hover:underline">Edit</a>
                    <form action="{{ route('admin.cyberrisks.destroy', $risk->id) }}"
                          method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:underline"
                                onclick="return confirm('Delete this risk?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted-foreground py-6">
                    No cybersecurity risks found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="mt-4">
    {{ $risks->links('pagination::tailwind') }}
</div>
