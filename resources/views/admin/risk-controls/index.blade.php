@extends('layouts.admin')

@section('title', 'Risk-Control Relationships')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Risk-Control Relationships</h1>
            <p class="text-muted-foreground text-sm">Map and manage control mitigations for each risk</p>
        </div>
        <a href="{{ route('admin.risk-controls.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Link
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        <input type="text" id="filter-risk" placeholder="Filter by Risk title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="pending">Pending</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="risk-controls-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.risk-controls.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableDiv = document.querySelector('#risk-controls-table');
    const riskInput = document.querySelector('#filter-risk');
    const statusSelect = document.querySelector('#filter-status');

    function fetchData() {
        const query = new URLSearchParams({
            'filter[risk.title]': riskInput.value,
            'filter[status]': statusSelect.value,
        }).toString();

        fetch(`{{ route('admin.risk-controls.index') }}?${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            tableDiv.innerHTML = html;
        })
        .catch(err => console.error(err));
    }

    function debounce(func, delay) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => func(...args), delay);
        };
    }

    const debouncedFetch = debounce(fetchData, 300);
    riskInput.addEventListener('input', debouncedFetch);
    statusSelect.addEventListener('change', fetchData);
});
</script>
@endpush
