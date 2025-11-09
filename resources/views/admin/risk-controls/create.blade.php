@extends('layouts.admin')

@section('title', 'Create Risk-Control Link')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up" data-aos-delay="0">
        <div data-aos="fade-up" data-aos-delay="0">
            <h1 class="text-2xl font-bold text-foreground">Create Risk-Control Relationship</h1>
            <p class="text-muted-foreground text-sm">Link an existing control to mitigate a specific risk</p>
        </div>
        <a href="{{ route('admin.risk-controls.index') }}"
           class="text-sm text-accent hover:underline">← Back to List</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.risk-controls.store') }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Risk --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <label for="risk_id" class="block text-sm font-medium text-foreground mb-1">Select Risk</label>
            <select id="risk_id" name="risk_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Choose a risk...</option>
                @foreach($risks as $risk)
                    <option value="{{ $risk->id }}" {{ old('risk_id') == $risk->id ? 'selected' : '' }}>
                        {{ $risk->title }}
                    </option>
                @endforeach
            </select>
            @error('risk_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Control --}}
        <div data-aos="fade-up" data-aos-delay="150">
            <label for="control_id" class="block text-sm font-medium text-foreground mb-1">Select Control</label>
            <select id="control_id" name="control_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Choose a control...</option>
                @foreach($controls as $control)
                    <option value="{{ $control->id }}" {{ old('control_id') == $control->id ? 'selected' : '' }}>
                        {{ $control->title }}
                    </option>
                @endforeach
            </select>
            @error('control_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Effectiveness --}}
        <div data-aos="fade-up" data-aos-delay="200">
            <label for="effectiveness" class="block text-sm font-medium text-foreground mb-1">Effectiveness</label>
            <input type="text" id="effectiveness" name="effectiveness" value="{{ old('effectiveness') }}"
                   placeholder="e.g. High, Medium, Low"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('effectiveness') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div data-aos="fade-up" data-aos-delay="250">
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4" data-aos="fade-up" data-aos-delay="300">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Create Link
            </button>
        </div>
    </form>
</div>
@endsection
