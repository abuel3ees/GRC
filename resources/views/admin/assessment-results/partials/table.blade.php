@if($results->count())
    <div class="overflow-x-auto border border-border rounded-md">
        <table class="min-w-full text-sm text-left text-foreground">
            <thead class="bg-muted/50 text-muted-foreground uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Assessment ID</th>
                    <th class="px-4 py-3">User ID</th>
                    <th class="px-4 py-3">Score</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr class="border-t border-border hover:bg-muted/30 transition">
                        <td class="px-4 py-3">{{ $result->id }}</td>
                        <td class="px-4 py-3">{{ $result->assessment_id }}</td>
                        <td class="px-4 py-3">{{ $result->user_id }}</td>
                        <td class="px-4 py-3">{{ $result->score }}%</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs
                                @if($result->status === 'completed') bg-emerald-500/20 text-emerald-400
                                @elseif($result->status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($result->status === 'reviewed') bg-blue-500/20 text-blue-400
                                @endif">
                                {{ ucfirst($result->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $result->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.assessment-results.show', $result) }}"
                               class="text-accent hover:underline">View</a>
                            <a href="{{ route('admin.assessment-results.edit', $result) }}"
                               class="text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('admin.assessment-results.destroy', $result) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-destructive hover:underline"
                                        onclick="return confirm('Delete this result?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
@else
    <div class="text-center py-12 text-muted-foreground text-sm">
        No assessment results found.
    </div>
@endif
