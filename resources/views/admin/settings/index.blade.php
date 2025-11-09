@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">

    {{-- ===== Page Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <h1 class="text-2xl font-bold text-foreground">System Settings</h1>
        <p class="text-muted-foreground text-sm">Manage environment and platform configuration</p>
    </div>

    {{-- ===== Flash Message ===== --}}
    @if(session('success'))
        <div class="p-3 rounded-md bg-emerald-600/20 border border-emerald-500 text-emerald-300 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ===== Settings Form ===== --}}
    <form method="POST" action="{{ route('admin.settings.update') }}" 
          class="bg-card border border-border rounded-xl p-8 shadow-sm space-y-6"
          data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1 text-foreground">App Name</label>
            <input type="text" name="app_name" value="{{ $settings['app_name'] }}"
                   class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md
                          focus:ring-2 focus:ring-ring/50 transition">
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm mb-1 text-foreground">Environment</label>
                <input type="text" readonly value="{{ $settings['app_env'] }}"
                       class="w-full px-4 py-2 border border-border bg-muted text-muted-foreground rounded-md">
            </div>
            <div>
                <label class="block text-sm mb-1 text-foreground">Debug Mode</label>
                <input type="text" readonly value="{{ $settings['app_debug'] ? 'Enabled' : 'Disabled' }}"
                       class="w-full px-4 py-2 border border-border bg-muted text-muted-foreground rounded-md">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1 text-foreground">Timezone</label>
            <input type="text" readonly value="{{ $settings['timezone'] }}"
                   class="w-full px-4 py-2 border border-border bg-muted text-muted-foreground rounded-md">
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-foreground text-background font-semibold rounded-md hover:opacity-90 transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
