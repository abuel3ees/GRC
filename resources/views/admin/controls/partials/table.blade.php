{{-- resources/views/admin/controls/partials/table.blade.php --}}
@if($controls->count())
    <div class="overflow-x-auto border border-border/60 rounded-lg bg-card text-card-foreground shadow-sm">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-muted/40 border-b border-border/60 text-foreground uppercase text-xs font-semibold tracking-wider">
                <tr>
                    <th scope="col" class="px-4 py-3">Control Title</th>
                    <th scope="col" class="px-4 py-3">Type</th>
                    <th scope="col" class="px-4 py-3">Related Risk</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">Last Updated</th>
                    <th scope="col" class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-border/60">
                @foreach($controls as $control)
                    <tr class="hover:bg-muted/30 transition">
                        {{-- Title --}}
                        <td class="px-4 py-3 font-medium text-foreground">
                            {{ $control->title }}
                        </td>

                        {{-- Type --}}
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ $control->type ?? '—' }}
                        </td>

                        {{-- Related Risk --}}
                        <td class="px-4 py-3 text-muted-foreground">
                            @if($control->risk)
                                <a href="{{ route('admin.risks.show', $control->risk_id) }}"
                                   class="text-accent hover:underline">
                                   {{ $control->risk->title }}
                                </a>
                            @else
                                <span class="text-muted-foreground">—</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                @if($control->status === 'active') bg-emerald-500/20 text-emerald-400
                                @elseif($control->status === 'inactive') bg-gray-500/20 text-gray-400
                                @elseif($control->status === 'under_review') bg-yellow-500/20 text-yellow-400
                                @else bg-muted/50 text-muted-foreground @endif">
                                {{ ucfirst(str_replace('_', ' ', $control->status)) }}
                            </span>
                        </td>

                        {{-- Updated --}}
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ $control->updated_at ? $control->updated_at->format('Y-m-d') : '—' }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 text-right space-x-2">
                            {{-- View --}}
                            <a href="{{ route('admin.controls.show', $control) }}"
                               class="inline-flex items-center px-2 py-1 text-xs rounded-md border border-border/50 hover:bg-muted/30 transition">
                                <span class="material-symbols-outlined text-[16px] mr-1">visibility</span>
                                View
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.controls.edit', $control) }}"
                               class="inline-flex items-center px-2 py-1 text-xs rounded-md bg-accent text-accent-foreground hover:opacity-90 transition">
                                <span class="material-symbols-outlined text-[16px] mr-1">edit</span>
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.controls.destroy', $control) }}" method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this control?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2 py-1 text-xs rounded-md bg-destructive text-destructive-foreground hover:opacity-90 transition">
                                    <span class="material-symbols-outlined text-[16px] mr-1">delete</span>
                                    Delete
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
        {{ $controls->links('pagination::tailwind') }}
    </div>
@else
    <div class="border border-border/60 rounded-lg bg-card text-muted-foreground text-center py-10">
        <p class="text-sm">No controls found. Create your first control to get started.</p>
    </div>
@endif
