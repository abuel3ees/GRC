@extends('layouts.admin')

@section('title', 'Requirement Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex justify-between items-center" data-aos="fade-up">
        <h1 class="text-2xl font-bold text-foreground">Requirement Details</h1>
        <a href="{{ route('admin.requirements.index') }}" 
           class="px-4 py-2 border border-border rounded-md hover:bg-secondary transition">← Back</a>
    </div>

    <div class="bg-card border border-border rounded-xl p-8 shadow-sm space-y-6" data-aos="fade-up">
        <p><strong>Framework:</strong> {{ $complianceRequirement->framework->name ?? '—' }}</p>
        <p><strong>Reference:</strong> {{ $complianceRequirement->reference_code ?? '—' }}</p>
        <p><strong>Title:</strong> {{ $complianceRequirement->title }}</p>
        <p><strong>Category:</strong> {{ $complianceRequirement->category ?? '—' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($complianceRequirement->status) }}</p>
        <p><strong>Description:</strong><br>{{ $complianceRequirement->description ?? '—' }}</p>
        <p><strong>Guidance:</strong><br>{{ $complianceRequirement->guidance ?? '—' }}</p>
        <p class="text-sm text-muted-foreground mt-4">Created {{ $complianceRequirement->created_at->diffForHumans() }}</p>
    </div>
</div>
@endsection
