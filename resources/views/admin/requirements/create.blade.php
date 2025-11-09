@extends('layouts.admin')

@section('title', 'Create Requirement')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <div class="flex justify-between items-center" data-aos="fade-up">
        <h1 class="text-2xl font-bold text-foreground">New Requirement</h1>
        <a href="{{ route('admin.requirements.index') }}" 
           class="px-4 py-2 border border-border rounded-md hover:bg-secondary transition">← Back</a>
    </div>

    <form action="{{ route('admin.requirements.store') }}" method="POST" 
          class="bg-card border border-border rounded-xl p-8 shadow-sm space-y-6" data-aos="fade-up">
        @csrf

        {{-- Framework --}}
        <div>
            <label class="block text-sm mb-1">Framework</label>
            <select name="framework_id" required
                    class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
                <option value="">Select Framework</option>
                @foreach ($frameworks as $fw)
                    <option value="{{ $fw->id }}">{{ $fw->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Title --}}
        <div>
            <label class="block text-sm mb-1">Title</label>
            <input name="title" required class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md"></textarea>
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md">
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="retired">Retired</option>
            </select>
        </div>

        <div class="flex justify-end pt-4">
            <button class="px-6 py-2 bg-foreground text-background rounded-md hover:opacity-90">Create</button>
        </div>
    </form>
</div>
@endsection
