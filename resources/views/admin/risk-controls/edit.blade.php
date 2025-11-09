@extends('layouts.admin')

@section('title', 'Edit Risk-Control Relationship')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Risk-Control Relationship</h1>
            <p class="text-muted-foreground text-sm">Modify link details or update its effectiveness</p>
        </div>
        <a href="{{ route('admin.risk-controls.show', $riskControl) }}"
           class="text-sm text-accent hover:underline">← Back to Details</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.risk-controls.update', $riskControl) }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Risk --}}
        <div>
            <label for="risk_id" class="block text-sm font-medium text-foreground mb-1">Select Risk</label>
            <select id="risk_id" name="risk_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @foreach($risks as $risk)
                    <option value="{{ $risk->id }}" {{ old('risk_id', $riskControl->risk_id) == $risk->id ? 'selected' : '' }}>
                        {{ $risk->title }}
                    </option>
                @endforeach
            </select>
            @error('risk_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Control --}}
        <div>
            <label for="control_id" class="block text-sm font-medium text-foreground mb-1">Select Control</label>
            <select id="control_id" name="control_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @foreach($controls as $control)
                    <option value="{{ $control->id }}" {{ old('control_id', $riskControl->control_id) == $control->id ? 'selected' : '' }}>
                        {{ $control->title }}
                    </option>
                @endforeach
            </select>
            @error('control_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Effectiveness --}}
        <div>
            <label for="effectiveness" class="block text-sm font-medium text-foreground mb-1">Effectiveness</label>
            <input type="text" id="effectiveness" name="effectiveness"
                   value="{{ old('effectiveness', $riskControl->effectiveness) }}"
                   placeholder="e.g. High, Medium, Low"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('effectiveness') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="active" {{ old('status', $riskControl->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ old('status', $riskControl->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="inactive" {{ old('status', $riskControl->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Update Relationship
            </button>
        </div>
    </form>
</div>
@endsection
