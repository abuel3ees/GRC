<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — GRC Platform</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="font-sans antialiased bg-background text-foreground">
<div class="flex h-screen overflow-hidden">

    {{-- ===== Sidebar ===== --}}
    @include('components.admin.sidebar')

    {{-- ===== Main Content ===== --}}
    <div class="flex flex-1 flex-col overflow-hidden">

        {{-- ===== Header ===== --}}
        @include('components.admin.header')

        {{-- ===== Page Content ===== --}}
        <main class="flex-1 overflow-y-auto p-8 space-y-10">
            {{-- ===== KPI CARDS ===== --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Key Metrics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-sm text-muted-foreground mb-2">Active Risks</h3>
                        <p class="text-3xl font-bold text-foreground">{{ $metrics['activeRisks'] ?? 0 }}</p>
                        <p class="text-xs text-muted-foreground mt-1">↑ 6% from last month</p>
                    </div>

                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-sm text-muted-foreground mb-2">Open Assessments</h3>
                        <p class="text-3xl font-bold text-foreground">{{ $metrics['openAssessments'] ?? 0 }}</p>
                        <p class="text-xs text-muted-foreground mt-1">↓ 4% from last week</p>
                    </div>

                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-sm text-muted-foreground mb-2">Controls Implemented</h3>
                        <p class="text-3xl font-bold text-foreground">{{ $metrics['controlsCoverage'] ?? 0 }}%</p>
                        <p class="text-xs text-muted-foreground mt-1">Coverage rate</p>
                    </div>

                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-sm text-muted-foreground mb-2">Compliance Score</h3>
                        <p class="text-3xl font-bold text-foreground">{{ number_format($metrics['complianceScore'] ?? 0, 1) }}%</p>
                        <p class="text-xs text-muted-foreground mt-1">Audit-ready status</p>
                    </div>
                </div>
            </section>

            {{-- ===== RISK HEATMAP ===== --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Risk Heatmap</h2>
                <div class="bg-card border border-border rounded-xl p-6">
                    <canvas id="riskHeatmap" class="w-full h-80"></canvas>
                </div>
            </section>

            {{-- ===== ANALYTICS ===== --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Analytical Insights</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Compliance Trend --}}
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-md font-semibold mb-4">Compliance Trend</h3>
                        <canvas id="complianceTrend"></canvas>
                    </div>

                    {{-- Assessment Status --}}
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-md font-semibold mb-4">Assessment Status</h3>
                        <canvas id="assessmentStatus"></canvas>
                    </div>
                </div>
            </section>

            {{-- ===== RECENT ACTIVITY ===== --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
                <div class="bg-card border border-border rounded-xl p-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-muted-foreground border-b border-border">
                        <tr>
                            <th class="py-2 text-left">Event</th>
                            <th class="py-2 text-left">Entity</th>
                            <th class="py-2 text-left">User</th>
                            <th class="py-2 text-left">Timestamp</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                        @forelse($activity as $log)
                            <tr>
                                <td class="py-2">{{ $log->event }}</td>
                                <td class="py-2">{{ $log->entity }}</td>
                                <td class="py-2">{{ $log->user }}</td>
                                <td class="py-2 text-muted-foreground">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-muted-foreground">
                                    No recent activity recorded.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ===== FOOTER ===== --}}
            <footer class="text-center text-sm text-muted-foreground mt-10">
                © {{ now()->year }} GRC Platform — Enterprise Governance, Risk & Compliance Analytics.
            </footer>
        </main>
    </div>
</div>

{{-- ====== CHARTS (REAL DATA) ====== --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const heatmapData = @json($heatmap);
    const trendData = @json($trend);
    const statusData = @json($status);

    // === RISK HEATMAP ===
    const heatmapCtx = document.getElementById("riskHeatmap").getContext("2d");
    new Chart(heatmapCtx, {
        type: "matrix",
        data: {
            datasets: [{
                label: "Risk Severity",
                data: heatmapData,
                backgroundColor: ctx => {
                    const value = ctx.dataset.data[ctx.dataIndex].v;
                    return value > 7
                        ? "rgb(220, 38, 38)"
                        : value > 3
                        ? "rgb(234, 179, 8)"
                        : "rgb(34, 197, 94)";
                },
                width: ({ chart }) => (chart.chartArea.width / 5) - 6,
                height: ({ chart }) => (chart.chartArea.height / 5) - 6,
            }]
        },
        options: {
            scales: { x: { display: false }, y: { display: false } },
            plugins: { legend: { display: false } }
        }
    });

    // === COMPLIANCE TREND ===
    const trendCtx = document.getElementById("complianceTrend").getContext("2d");
    new Chart(trendCtx, {
        type: "line",
        data: {
            labels: trendData.map(t => t.month),
            datasets: [{
                label: "Compliance %",
                data: trendData.map(t => t.avg_score ?? 0),
                borderColor: "rgb(99,102,241)",
                backgroundColor: "rgba(99,102,241,0.2)",
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });

    // === ASSESSMENT STATUS ===
    const statusCtx = document.getElementById("assessmentStatus").getContext("2d");
    new Chart(statusCtx, {
        type: "doughnut",
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: ["#EAB308", "#6366F1", "#22C55E", "#EF4444"],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: "bottom" } },
            cutout: "70%"
        }
    });
});
</script>
</body>
</html>
