@extends('layouts.admin')

@section('title', 'Edit Requirement')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <div class="flex justify-between items-center" data-aos="fade-up">
        <h1 class="text-2xl font-bold text-foreground">Edit Requirement</h1>
        <a href="{{ route('admin.requirements.index') }}" 
           class="px-4 py-2 border border-border rounded-md hover:bg-secondary transition">← Back</a>
    </div>

    <form action="{{ route('admin.requirements.update', $complianceRequirement->id) }}" method="POST" 
          class="bg-card border border-border rounded-xl p-8 shadow-sm space-y-6" data-aos="fade-up">
        @csrf @method('PUT')

        {{-- Framework --}}
        <div>
            <label class="block text-sm mb-1">Framework</label>
            <select name="framework_id" required class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
                @foreach ($frameworks as $fw)
                    <option value="{{ $fw->id }}" {{ $fw->id == $complianceRequirement->framework_id ? 'selected' : '' }}>
                        {{ $fw->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Title --}}
        <div>
            <label class="block text-sm mb-1">Title</label>
            <input name="title" value="{{ $complianceRequirement->title }}" required
                   class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">{{ $complianceRequirement->description }}</textarea>
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
                <option value="active" {{ $complianceRequirement->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ $complianceRequirement->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="retired" {{ $complianceRequirement->status == 'retired' ? 'selected' : '' }}>Retired</option>
            </select>
        </div>

        <div class="flex justify-end pt-4">
            <button class="px-6 py-2 bg-foreground text-background rounded-md hover:opacity-90">Update</button>
        </div>
    </form>
</div>
@endsection
