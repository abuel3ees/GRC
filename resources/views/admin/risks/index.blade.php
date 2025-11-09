@extends('layouts.admin')

@section('title', 'Risks')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Risks</h1>
            <p class="text-muted-foreground text-sm">Monitor, assess, and manage enterprise risks effectively</p>
        </div>
        <a href="{{ route('admin.risks.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Risk
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        {{-- Search by title --}}
        <input type="text" id="search-title" placeholder="Search title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        {{-- Filter by category --}}
        <select id="filter-category"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Categories</option>
            <option value="Operational">Operational</option>
            <option value="Financial">Financial</option>
            <option value="Strategic">Strategic</option>
            <option value="Compliance">Compliance</option>
        </select>

        {{-- Filter by severity --}}
        <select id="filter-severity"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Severities</option>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>

        {{-- Filter by status --}}
        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="open">Open</option>
            <option value="mitigated">Mitigated</option>
            <option value="closed">Closed</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="risks-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.risks.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableDiv = document.querySelector('#risks-table');
        const titleInput = document.querySelector('#search-title');
        const categorySelect = document.querySelector('#filter-category');
        const severitySelect = document.querySelector('#filter-severity');
        const statusSelect = document.querySelector('#filter-status');

        function fetchData() {
            const query = new URLSearchParams({
                'filter[title]': titleInput.value,
                'filter[category]': categorySelect.value,
                'filter[severity]': severitySelect.value,
                'filter[status]': statusSelect.value,
            }).toString();

            fetch(`{{ route('admin.risks.index') }}?${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    tableDiv.innerHTML = html;
                })
                .catch(err => console.error(err));
        }

        // Debounce to prevent spam reloads
        function debounce(func, delay) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => func(...args), delay);
            };
        }

        const debouncedFetch = debounce(fetchData, 300);

        titleInput.addEventListener('input', debouncedFetch);
        categorySelect.addEventListener('change', fetchData);
        severitySelect.addEventListener('change', fetchData);
        statusSelect.addEventListener('change', fetchData);
    });
</script>
@endpush
