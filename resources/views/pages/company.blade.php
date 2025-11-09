@extends('layouts.app')

@section('title', 'Company | GRC Platform')

@section('content')
@include('components.header')

<section class="min-h-screen flex flex-col items-center justify-center text-center bg-background text-foreground px-6 py-20">
    <h1 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter mb-6">About Our Company</h1>
    <p class="text-lg text-muted-foreground max-w-2xl">
        We’re building the future of governance, risk, and compliance — empowering organizations to stay secure, ethical, and compliant.
    </p>

    <div class="mt-16 text-sm text-muted-foreground">
        <p>Based in Amman, Jordan — proudly innovating enterprise GRC solutions for the modern era.</p>
    </div>
</section>

@include('components.footer')
@endsection
