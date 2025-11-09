@extends('layouts.admin')

@section('title', 'Controls')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Controls</h1>
            <p class="text-muted-foreground text-sm">
                Manage all control measures ensuring proper risk mitigation and compliance.
            </p>
        </div>
        <a href="{{ route('admin.controls.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Control
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        {{-- Search by title --}}
        <input type="text" id="search-title" placeholder="Search control title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        {{-- Filter by type --}}
        <select id="filter-type"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Types</option>
            <option value="Preventive">Preventive</option>
            <option value="Detective">Detective</option>
            <option value="Corrective">Corrective</option>
        </select>

        {{-- Filter by status --}}
        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="under_review">Under Review</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="controls-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.controls.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableDiv = document.querySelector('#controls-table');
        const titleInput = document.querySelector('#search-title');
        const typeSelect = document.querySelector('#filter-type');
        const statusSelect = document.querySelector('#filter-status');

        function fetchData() {
            const query = new URLSearchParams({
                'filter[title]': titleInput.value,
                'filter[type]': typeSelect.value,
                'filter[status]': statusSelect.value,
            }).toString();

            fetch(`{{ route('admin.controls.index') }}?${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    tableDiv.innerHTML = html;
                })
                .catch(err => console.error(err));
        }

        // Debounce for performance
        function debounce(func, delay) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => func(...args), delay);
            };
        }

        const debouncedFetch = debounce(fetchData, 300);

        titleInput.addEventListener('input', debouncedFetch);
        typeSelect.addEventListener('change', fetchData);
        statusSelect.addEventListener('change', fetchData);
    });
</script>
@endpush
