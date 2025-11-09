@php
    $features = [
        [
            'icon' => '01',
            'title' => 'Risk Management',
            'description' => 'Identify, assess, and mitigate enterprise risks in real-time with advanced analytics.',
        ],
        [
            'icon' => '02',
            'title' => 'Compliance Automation',
            'description' => 'Automate compliance workflows and reduce manual effort by up to 80%.',
        ],
        [
            'icon' => '03',
            'title' => 'Audit Trail',
            'description' => 'Complete transparency with immutable audit logs and compliance documentation.',
        ],
        [
            'icon' => '04',
            'title' => 'Policy Management',
            'description' => 'Centralized policy creation, distribution, and enforcement across the organization.',
        ],
    ];
@endphp

<section class="w-full py-24 md:py-32 bg-foreground text-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== Section Header ===== --}}
        <div class="mb-20">
            <h2 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter mb-6 text-balance">
                Comprehensive Solutions
            </h2>
            <p class="text-xl text-background/80 max-w-2xl">
                All the tools you need to manage governance, risk, and compliance effectively.
            </p>
        </div>

        {{-- ===== Features Grid ===== --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($features as $feature)
                <div class="border border-background/30 p-8 space-y-4 hover:border-background/60 transition group rounded-md">
                    <div class="text-5xl font-bold font-mono text-background/40 group-hover:text-background/60 transition">
                        {{ $feature['icon'] }}
                    </div>
                    <h3 class="text-xl font-bold font-sans">{{ $feature['title'] }}</h3>
                    <p class="text-background/80 leading-relaxed">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
