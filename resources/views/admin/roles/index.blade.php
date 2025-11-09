@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Roles</h1>
            <p class="text-muted-foreground text-sm">Manage system roles and permissions</p>
        </div>
        <a href="{{ route('admin.roles.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New Role
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        <input type="text" id="search-name" placeholder="Search role name..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">
        <input type="text" id="search-description" placeholder="Search description..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="roles-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.roles.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableDiv = document.querySelector('#roles-table');
    const nameInput = document.querySelector('#search-name');
    const descInput = document.querySelector('#search-description');

    function fetchData() {
        const query = new URLSearchParams({
            'filter[name]': nameInput.value,
            'filter[description]': descInput.value,
        }).toString();

        fetch(`{{ route('admin.roles.index') }}?${query}`, {
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
    nameInput.addEventListener('input', debouncedFetch);
    descInput.addEventListener('input', debouncedFetch);
});
</script>
@endpush
