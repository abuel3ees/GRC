@extends('layouts.admin')

@section('title', 'Cybersecurity Risks')

@section('content')
<div class="p-6 space-y-6">

    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Cybersecurity Risk Register</h1>
            <p class="text-muted-foreground text-sm">
                View and manage all cybersecurity risks, their likelihood, impact, and mitigation plans.
            </p>
        </div>

        <a href="{{ route('admin.cyberrisks.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Risk
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        {{-- Search by title --}}
        <input type="text" id="search-title" placeholder="Search risk title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        {{-- Filter by Residual Level --}}
        <select id="filter-residual"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Residual Levels</option>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>

        {{-- Filter by Score --}}
        <select id="filter-score"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Scores</option>
            <option value=">=15">High (≥15)</option>
            <option value="<15">Medium (&lt;15)</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="cyberrisks-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.cyberrisks.partials.table')
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableDiv = document.querySelector('#cyberrisks-table');
        const titleInput = document.querySelector('#search-title');
        const residualSelect = document.querySelector('#filter-residual');
        const scoreSelect = document.querySelector('#filter-score');

        function fetchData() {
            const query = new URLSearchParams({
                'filter[title]': titleInput.value,
                'filter[residual_level]': residualSelect.value,
                'filter[score]': scoreSelect.value,
            }).toString();

            fetch(`{{ route('admin.cyberrisks.index') }}?${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    tableDiv.innerHTML = html;
                })
                .catch(err => console.error(err));
        }

        // Debounce for search input
        function debounce(func, delay) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => func(...args), delay);
            };
        }

        const debouncedFetch = debounce(fetchData, 300);

        titleInput.addEventListener('input', debouncedFetch);
        residualSelect.addEventListener('change', fetchData);
        scoreSelect.addEventListener('change', fetchData);
    });
</script>
@endpush
