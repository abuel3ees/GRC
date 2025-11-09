@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Users</h1>
            <p class="text-muted-foreground text-sm">Manage system users and their roles</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition">
           + New User
        </a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-4 items-center" data-aos="fade-up" data-aos-delay="100">
        <input type="text" id="search-name" placeholder="Search by name..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        <input type="text" id="search-email" placeholder="Search by email..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">

        <select id="filter-role"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="user">User</option>
        </select>

        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    {{-- ===== Data Table ===== --}}
    <div id="users-table" data-aos="fade-up" data-aos-delay="150">
        @include('admin.users.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableDiv = document.querySelector('#users-table');
    const nameInput = document.querySelector('#search-name');
    const emailInput = document.querySelector('#search-email');
    const roleSelect = document.querySelector('#filter-role');
    const statusSelect = document.querySelector('#filter-status');

    function fetchData() {
        const query = new URLSearchParams({
            'filter[name]': nameInput.value,
            'filter[email]': emailInput.value,
            'filter[role]': roleSelect.value,
            'filter[status]': statusSelect.value,
        }).toString();

        fetch(`{{ route('admin.users.index') }}?${query}`, {
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
    emailInput.addEventListener('input', debouncedFetch);
    roleSelect.addEventListener('change', fetchData);
    statusSelect.addEventListener('change', fetchData);
});
</script>
@endpush
