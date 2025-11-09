{{-- resources/views/admin/risk-controls/partials/table.blade.php --}}
<table class="min-w-full text-sm border border-border/60 rounded-md overflow-hidden">
    <thead class="bg-muted/40 text-foreground">
        <tr>
            <th class="px-4 py-3 text-left font-semibold">Risk</th>
            <th class="px-4 py-3 text-left font-semibold">Control</th>
            <th class="px-4 py-3 text-left font-semibold">Effectiveness</th>
            <th class="px-4 py-3 text-left font-semibold">Status</th>
            <th class="px-4 py-3 text-left font-semibold">Created</th>
            <th class="px-4 py-3 text-right font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border/50 text-muted-foreground">
        @forelse ($riskControls as $link)
            <tr class="hover:bg-muted/20 transition">
                <td class="px-4 py-3 text-foreground font-medium">{{ $link->risk->title ?? '—' }}</td>
                <td class="px-4 py-3 text-foreground font-medium">{{ $link->control->title ?? '—' }}</td>
                <td class="px-4 py-3">{{ $link->effectiveness ?? 'Not specified' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full
                        @if($link->status === 'active') bg-green-500/20 text-green-400
                        @elseif($link->status === 'pending') bg-yellow-500/20 text-yellow-400
                        @else bg-gray-500/20 text-gray-400 @endif">
                        {{ ucfirst($link->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $link->created_at->diffForHumans() }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.risk-controls.show', $link) }}" class="text-accent hover:underline text-sm">View</a>
                    <a href="{{ route('admin.risk-controls.edit', $link) }}" class="text-blue-400 hover:underline text-sm">Edit</a>
                    <form action="{{ route('admin.risk-controls.destroy', $link) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-400 hover:underline text-sm"
                            onclick="return confirm('Delete this relationship?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-muted-foreground">
                    No risk-control links found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $riskControls->links() }}
</div>
