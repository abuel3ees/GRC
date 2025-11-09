@extends('layouts.admin')

@section('title', 'Assessments')

@section('content')
<div class="p-6 space-y-8">

    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up" data-aos-delay="0">
        <div data-aos="fade-right">
            <h1 class="text-2xl font-bold text-foreground">Assessments</h1>
            <p class="text-muted-foreground text-sm">Manage and review all enterprise assessments</p>
        </div>
        <a href="{{ route('admin.assessments.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition"
           data-aos="zoom-in" data-aos-delay="100">
           + New Assessment
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="150">
        <input type="text" id="search-title" placeholder="Search title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50 transition"
               data-aos="fade-right" data-aos-delay="200">

        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 transition"
                data-aos="fade-left" data-aos-delay="250">
            <option value="">All Statuses</option>
            <option value="draft">Draft</option>
            <option value="active">Active</option>
            <option value="closed">Closed</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="assessments-table" class="border border-border rounded-xl bg-card shadow-sm" 
         data-aos="fade-up" data-aos-delay="300">
        @include('admin.assessments.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableDiv = document.querySelector('#assessments-table');
    const titleInput = document.querySelector('#search-title');
    const statusSelect = document.querySelector('#filter-status');

    function fetchData() {
        const query = new URLSearchParams({
            'filter[title]': titleInput.value,
            'filter[status]': statusSelect.value,
        }).toString();

        fetch(`{{ route('admin.assessments.index') }}?${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            tableDiv.innerHTML = html;
            AOS.refresh(); // re-trigger animations for dynamically loaded content
        })
        .catch(err => console.error(err));
    }

    // Debounce helper
    function debounce(func, delay) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => func(...args), delay);
        };
    }

    const debouncedFetch = window._?.debounce ? _.debounce(fetchData, 300) : debounce(fetchData, 300);
    titleInput.addEventListener('input', debouncedFetch);
    statusSelect.addEventListener('change', fetchData);
});
</script>

    <!-- ===== AOS (Animate On Scroll) ===== -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize AOS after Tailwind/Vite render
            if (window.AOS) {
                AOS.init({
                    duration: 800,       // smooth animation speed
                    easing: 'ease-in-out',
                    once: false,         // allow re-animation on scroll
                    offset: 80,          // trigger point
                });
                console.log('✅ AOS Initialized');
            } else {
                console.error('❌ AOS not found in window scope');
            }
        });
    </script>

    {{-- ===== Stack for page-specific scripts ===== --}}
    @stack('scripts')
</body>
</html>
@endpush
