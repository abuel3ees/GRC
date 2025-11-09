<table class="min-w-full text-sm border border-border rounded-lg overflow-hidden">
    <thead class="bg-muted text-muted-foreground uppercase text-xs">
        <tr>
            <th class="px-4 py-2 text-left">Title</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Created At</th>
            <th class="px-4 py-2 text-right">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border">
        @forelse($assessments as $assessment)
            <tr class="hover:bg-muted/50 transition">
                <td class="px-4 py-2">{{ $assessment->title }}</td>
                <td class="px-4 py-2">{{ ucfirst($assessment->status) }}</td>
                <td class="px-4 py-2">{{ $assessment->created_at->format('Y-m-d') }}</td>
                <td class="px-4 py-2 text-right space-x-2">
                    <a href="{{ route('admin.assessments.edit', $assessment) }}" class="text-accent hover:underline">Edit</a>
                    <form action="{{ route('admin.assessments.destroy', $assessment) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-destructive hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center py-4 text-muted-foreground">No assessments found.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $assessments->links() }}</div>
