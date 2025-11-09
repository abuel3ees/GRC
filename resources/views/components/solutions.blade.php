@php
    $solutions = [
        [
            'title' => 'Financial Services',
            'items' => ['Regulatory Compliance', 'Risk Assessment', 'Audit Management'],
        ],
        [
            'title' => 'Healthcare',
            'items' => ['HIPAA Compliance', 'Data Privacy', 'Quality Assurance'],
        ],
        [
            'title' => 'Technology',
            'items' => ['Security Compliance', 'Data Governance', 'Risk Analysis'],
        ],
    ];
@endphp

<section class="w-full py-24 md:py-32 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== Section Header ===== --}}
        <div class="mb-16">
            <h2 class="text-5xl md:text-6xl font-bold font-sans tracking-tighter text-balance">
                Industry Solutions
            </h2>
        </div>

        {{-- ===== Solutions Grid ===== --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($solutions as $solution)
                <div class="border border-border p-8 space-y-6 rounded-md">
                    <h3 class="text-2xl font-bold font-sans">{{ $solution['title'] }}</h3>
                    <ul class="space-y-3">
                        @foreach ($solution['items'] as $item)
                            <li class="flex items-start gap-3">
                                <span class="w-1 h-1 bg-foreground rounded-full mt-2 flex-shrink-0"></span>
                                <span class="text-muted-foreground">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

    </div>
</section>
