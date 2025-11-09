{{-- resources/views/admin/roles/partials/table.blade.php --}}
<table class="min-w-full text-sm border border-border/60 rounded-md overflow-hidden">
    <thead class="bg-muted/40 text-foreground">
        <tr>
            <th class="px-4 py-3 text-left font-semibold">Role Name</th>
            <th class="px-4 py-3 text-left font-semibold">Description</th>
            <th class="px-4 py-3 text-left font-semibold">Created</th>
            <th class="px-4 py-3 text-right font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border/50 text-muted-foreground">
        @forelse ($roles as $role)
            <tr class="hover:bg-muted/20 transition">
                <td class="px-4 py-3 text-foreground font-medium">{{ $role->name }}</td>
                <td class="px-4 py-3">{{ $role->description ?? '—' }}</td>
                <td class="px-4 py-3">{{ $role->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.roles.show', $role) }}" class="text-accent hover:underline text-sm">View</a>
                    <a href="{{ route('admin.roles.edit', $role) }}" class="text-blue-400 hover:underline text-sm">Edit</a>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-400 hover:underline text-sm"
                                onclick="return confirm('Delete this role?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-muted-foreground">
                    No roles found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $roles->links() }}
</div>
