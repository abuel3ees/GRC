@extends('layouts.app')

@section('title', 'Platform | GRC Platform')

@section('content')
@include('components.header')

<section class="min-h-screen flex flex-col items-center justify-center text-center bg-background text-foreground px-6 py-20">
    <h1 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter mb-6">Our Platform</h1>
    <p class="text-lg text-muted-foreground max-w-2xl">
        Explore the capabilities of our unified Governance, Risk, and Compliance system — built to scale across your enterprise.
    </p>

    <div class="mt-16 max-w-5xl">
        @include('components.features')
    </div>
</section>

@include('components.footer')
@endsection
