@extends('layouts.admin')

@section('title', 'Assessment Results')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Assessment Results</h1>
            <p class="text-muted-foreground text-sm">
                Review, filter, and manage all recorded assessment outcomes
            </p>
        </div>
        <a href="{{ route('admin.assessment-results.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Result
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        <input type="text" id="search-assessment" placeholder="Search by Assessment ID..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        <input type="text" id="search-user" placeholder="Search by User ID..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="reviewed">Reviewed</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="assessment-results-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.assessment-results.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableDiv = document.querySelector('#assessment-results-table');
    const assessmentInput = document.querySelector('#search-assessment');
    const userInput = document.querySelector('#search-user');
    const statusSelect = document.querySelector('#filter-status');

    function fetchData() {
        const query = new URLSearchParams({
            'filter[assessment_id]': assessmentInput.value,
            'filter[user_id]': userInput.value,
            'filter[status]': statusSelect.value,
        }).toString();

        fetch(`{{ route('admin.assessment-results.index') }}?${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.text())
            .then(html => {
                tableDiv.innerHTML = html;
            })
            .catch(err => console.error(err));
    }

    // Simple debounce (if Lodash not loaded)
    function debounce(func, delay) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => func(...args), delay);
        };
    }

    const debouncedFetch = window._?.debounce ? _.debounce(fetchData, 300) : debounce(fetchData, 300);
    assessmentInput.addEventListener('input', debouncedFetch);
    userInput.addEventListener('input', debouncedFetch);
    statusSelect.addEventListener('change', fetchData);
});
</script>
@endpush
