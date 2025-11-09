@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-center" data-aos="fade-up">
        <h1 class="text-2xl font-bold text-foreground">Analytics Overview</h1>
        <p class="text-muted-foreground text-sm">System performance and statistics</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-sm text-muted-foreground">Total Users</h2>
            <p class="text-2xl font-semibold text-foreground">{{ $data['total_users'] }}</p>
        </div>

        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-sm text-muted-foreground">Total Assessments</h2>
            <p class="text-2xl font-semibold text-foreground">{{ $data['total_assessments'] }}</p>
        </div>

        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-sm text-muted-foreground">Active Risks</h2>
            <p class="text-2xl font-semibold text-foreground">{{ $data['active_risks'] }}</p>
        </div>

        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-sm text-muted-foreground">Compliance Requirements</h2>
            <p class="text-2xl font-semibold text-foreground">{{ $data['compliance_requirements'] }}</p>
        </div>
    </div>
</div>
@endsection
