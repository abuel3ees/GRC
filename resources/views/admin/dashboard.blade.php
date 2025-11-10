<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — GRC Platform</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- AOS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

    <style>
        /* Sleek chart sizing and spacing */
        canvas {
            max-height: 220px !important;
        }
        #riskHeatmap {
            height: 260px !important;
            border-radius: 12px;
        }
        section {
            scroll-margin-top: 80px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-background text-foreground"
      data-aos-easing="ease-in-out" data-aos-duration="500"
      data-aos-offset="40" data-aos-once="true">

<div class="flex h-screen overflow-hidden" data-aos="fade-up">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    {{-- Main --}}
    <div class="flex flex-1 flex-col overflow-hidden" data-aos="fade-up">
        @include('components.admin.header')

        <main class="flex-1 overflow-y-auto p-8 space-y-10" data-aos="fade-up">

            {{-- KPI Cards --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Key Metrics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-sm text-muted-foreground mb-2">Active Risks</h3>
                        <p class="text-3xl font-bold">{{ $metrics['activeRisks'] ?? 0 }}</p>
                        <p class="text-xs text-muted-foreground mt-1">↑ 6% from last month</p>
                    </div>
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-sm text-muted-foreground mb-2">Open Assessments</h3>
                        <p class="text-3xl font-bold">{{ $metrics['openAssessments'] ?? 0 }}</p>
                        <p class="text-xs text-muted-foreground mt-1">↓ 4% from last week</p>
                    </div>
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-sm text-muted-foreground mb-2">Controls Implemented</h3>
                        <p class="text-3xl font-bold">{{ $metrics['controlsCoverage'] ?? 0 }}%</p>
                        <p class="text-xs text-muted-foreground mt-1">Coverage rate</p>
                    </div>
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-sm text-muted-foreground mb-2">Compliance Score</h3>
                        <p class="text-3xl font-bold">{{ number_format($metrics['complianceScore'] ?? 0, 1) }}%</p>
                        <p class="text-xs text-muted-foreground mt-1">Audit-ready status</p>
                    </div>
                </div>
            </section>

            {{-- Risk Heatmap --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Risk Heatmap</h2>
                <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                    <canvas id="riskHeatmap"></canvas>
                </div>
            </section>

            {{-- Analytical Insights --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Analytical Insights</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-md font-semibold mb-4">Compliance Trend</h3>
                        <canvas id="complianceTrend"></canvas>
                    </div>
                    <div class="bg-card border border-border rounded-xl p-5 shadow-sm">
                        <h3 class="text-md font-semibold mb-4">Assessment Status</h3>
                        <canvas id="assessmentStatus"></canvas>
                    </div>
                </div>
            </section>

            {{-- Recent Activity --}}
            <section>
                <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
                <div class="bg-card border border-border rounded-xl p-5 overflow-x-auto shadow-sm">
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
                                <td class="py-2 text-muted-foreground">
                                    {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}
                                </td>
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

            <footer class="text-center text-sm text-muted-foreground mt-10">
                © {{ now()->year }} GRC Platform — Enterprise Governance, Risk & Compliance Analytics.
            </footer>
        </main>
    </div>
</div>

<!-- AOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    AOS.init({ duration: 400, once: true, offset: 40 });

    const heatmapData = @json($heatmap);
    const trendData = @json($trend);
    const statusData = @json($status);

    Chart.defaults.color = "#d1d5db";
    Chart.defaults.font.family = "Roboto Flex, sans-serif";
    Chart.defaults.font.size = 11;

    // === RISK HEATMAP ===
    const ctx = document.getElementById("riskHeatmap").getContext("2d");

    new Chart(ctx, {
        type: "scatter",
        data: {
            datasets: [{
                label: "Cyber Risks",
                data: heatmapData,
                backgroundColor: item => {
                    const level = item.raw.residual_level;
                    return level === "High" ? "#ef4444" :
                           level === "Medium" ? "#eab308" :
                           "#22c55e";
                },
                borderColor: "#fff",
                borderWidth: 1.2,
                pointRadius: 7,
                pointHoverRadius: 9,
                pointStyle: "circle"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: 20 },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "rgba(17,24,39,0.9)",
                    borderColor: "#444",
                    borderWidth: 1,
                    titleColor: "#fff",
                    bodyColor: "#e5e7eb",
                    callbacks: { label: ctx => ctx.raw.label }
                }
            },
            scales: {
                x: {
                    min: 0.5,
                    max: 5.5,
                    title: {
                        display: true,
                        text: "Probability →",
                        color: "#d1d5db",
                        font: { size: 13, weight: "bold" }
                    },
                    ticks: { stepSize: 1, color: "#9ca3af" },
                    grid: { color: "rgba(255,255,255,0.05)" }
                },
                y: {
                    min: 0.5,
                    max: 5.5,
                    reverse: true,
                    title: {
                        display: true,
                        text: "↑ Impact",
                        color: "#d1d5db",
                        font: { size: 13, weight: "bold" }
                    },
                    ticks: { stepSize: 1, color: "#9ca3af" },
                    grid: { color: "rgba(255,255,255,0.05)" }
                }
            },
            backgroundColor: "#000"
        },
        plugins: [{
            id: "heatGradient",
            beforeDraw(chart) {
                const {ctx, chartArea} = chart;
                if (!chartArea) return;
                const gradient = ctx.createLinearGradient(chartArea.left, chartArea.bottom, chartArea.right, chartArea.top);
                gradient.addColorStop(0, "#22c55e");
                gradient.addColorStop(0.5, "#eab308");
                gradient.addColorStop(1, "#ef4444");
                ctx.save();
                ctx.fillStyle = gradient;
                ctx.fillRect(chartArea.left, chartArea.top, chartArea.width, chartArea.height);
                ctx.restore();
            }
        }]
    });

    // Legend below the chart
    const legendContainer = document.createElement("div");
    legendContainer.className = "flex justify-center gap-6 mt-3 text-sm text-muted-foreground";
    legendContainer.innerHTML = `
        <div class="flex items-center gap-2"><span class="w-4 h-4 rounded-sm bg-green-500"></span><span>Low Risk</span></div>
        <div class="flex items-center gap-2"><span class="w-4 h-4 rounded-sm bg-yellow-500"></span><span>Medium Risk</span></div>
        <div class="flex items-center gap-2"><span class="w-4 h-4 rounded-sm bg-red-500"></span><span>High Risk</span></div>
    `;
    document.getElementById("riskHeatmap").parentNode.appendChild(legendContainer);

    // === COMPLIANCE TREND ===
    new Chart(document.getElementById("complianceTrend").getContext("2d"), {
        type: "line",
        data: {
            labels: trendData.map(t => t.month),
            datasets: [{
                data: trendData.map(t => t.avg_score ?? 0),
                borderColor: "#6366f1",
                backgroundColor: "rgba(99,102,241,0.15)",
                fill: true,
                tension: 0.35,
                borderWidth: 1.5,
                pointRadius: 2,
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: "#9ca3af" } },
                y: { beginAtZero: true, max: 100, grid: { color: "rgba(255,255,255,0.05)" }, ticks: { color: "#9ca3af" } }
            }
        }
    });

    // === ASSESSMENT STATUS ===
    new Chart(document.getElementById("assessmentStatus").getContext("2d"), {
        type: "doughnut",
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: ["#eab308", "#6366f1", "#22c55e", "#ef4444"],
                borderWidth: 0,
                hoverOffset: 4,
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.1,
            cutout: "75%",
            plugins: {
                legend: {
                    position: "bottom",
                    labels: { color: "#9ca3af", padding: 10, font: { size: 11 } }
                },
                tooltip: {
                    backgroundColor: "rgba(20,20,20,0.9)",
                    borderColor: "#444",
                    borderWidth: 1,
                    titleColor: "#fff",
                    bodyColor: "#d1d5db"
                }
            }
        }
    });
});
</script>
</body>
</html>
