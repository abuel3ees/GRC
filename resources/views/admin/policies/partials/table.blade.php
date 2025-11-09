{{-- resources/views/admin/policies/partials/table.blade.php --}}
<table class="min-w-full text-sm border border-border/60 rounded-md overflow-hidden">
    <thead class="bg-muted/40 text-foreground">
        <tr>
            <th class="px-4 py-3 text-left font-semibold">Title</th>
            <th class="px-4 py-3 text-left font-semibold">Category</th>
            <th class="px-4 py-3 text-left font-semibold">Status</th>
            <th class="px-4 py-3 text-left font-semibold">Created</th>
            <th class="px-4 py-3 text-right font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border/50 text-muted-foreground">
        @forelse ($policies as $policy)
            <tr class="hover:bg-muted/20 transition">
                <td class="px-4 py-3 text-foreground font-medium">{{ $policy->title }}</td>
                <td class="px-4 py-3">{{ $policy->category }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full
                        @if($policy->status === 'active') bg-green-500/20 text-green-400
                        @elseif($policy->status === 'draft') bg-yellow-500/20 text-yellow-400
                        @else bg-gray-500/20 text-gray-400 @endif">
                        {{ ucfirst($policy->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $policy->created_at->diffForHumans() }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.policies.show', $policy) }}"
                       class="text-accent hover:underline text-sm">View</a>
                    <a href="{{ route('admin.policies.edit', $policy) }}"
                       class="text-blue-400 hover:underline text-sm">Edit</a>
                    <form action="{{ route('admin.policies.destroy', $policy) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-400 hover:underline text-sm"
                            onclick="return confirm('Are you sure you want to delete this policy?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-muted-foreground">
                    No policies found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $policies->links() }}
</div>
