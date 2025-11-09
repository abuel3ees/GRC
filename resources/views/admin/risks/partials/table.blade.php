{{-- resources/views/admin/risks/partials/table.blade.php --}}
@if($risks->count())
    <div class="overflow-x-auto border border-border/60 rounded-lg bg-card text-card-foreground shadow-sm">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-muted/40 border-b border-border/60 text-foreground uppercase text-xs font-semibold tracking-wider">
                <tr>
                    <th scope="col" class="px-4 py-3">Title</th>
                    <th scope="col" class="px-4 py-3">Category</th>
                    <th scope="col" class="px-4 py-3">Severity</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">Created</th>
                    <th scope="col" class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/60">
                @foreach($risks as $risk)
                    <tr class="hover:bg-muted/30 transition">
                        {{-- Title --}}
                        <td class="px-4 py-3 font-medium text-foreground">
                            {{ $risk->title }}
                        </td>

                        {{-- Category --}}
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ $risk->category ?? '—' }}
                        </td>

                        {{-- Severity --}}
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                @if($risk->severity === 'High') bg-red-500/20 text-red-400
                                @elseif($risk->severity === 'Medium') bg-yellow-500/20 text-yellow-400
                                @elseif($risk->severity === 'Low') bg-emerald-500/20 text-emerald-400
                                @else bg-muted/50 text-muted-foreground @endif">
                                {{ ucfirst($risk->severity) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                @if($risk->status === 'open') bg-blue-500/20 text-blue-400
                                @elseif($risk->status === 'mitigated') bg-emerald-500/20 text-emerald-400
                                @elseif($risk->status === 'closed') bg-gray-500/20 text-gray-400
                                @else bg-muted/50 text-muted-foreground @endif">
                                {{ ucfirst($risk->status) }}
                            </span>
                        </td>

                        {{-- Created Date --}}
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ $risk->created_at ? $risk->created_at->format('Y-m-d') : '—' }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 text-right space-x-2">
                            {{-- View --}}
                            <a href="{{ route('admin.risks.show', $risk) }}"
                               class="inline-flex items-center px-2 py-1 text-xs rounded-md border border-border/50 hover:bg-muted/30 transition">
                                <span class="material-symbols-outlined text-[16px] mr-1">visibility</span> View
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.risks.edit', $risk) }}"
                               class="inline-flex items-center px-2 py-1 text-xs rounded-md bg-accent text-accent-foreground hover:opacity-90 transition">
                                <span class="material-symbols-outlined text-[16px] mr-1">edit</span> Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.risks.destroy', $risk) }}" method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this risk?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2 py-1 text-xs rounded-md bg-destructive text-destructive-foreground hover:opacity-90 transition">
                                    <span class="material-symbols-outlined text-[16px] mr-1">delete</span> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $risks->links('pagination::tailwind') }}
    </div>
@else
    <div class="border border-border/60 rounded-lg bg-card text-muted-foreground text-center py-10">
        <p class="text-sm">No risks found. Create your first one to get started.</p>
    </div>
@endif
