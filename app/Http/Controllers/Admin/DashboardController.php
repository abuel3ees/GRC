<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Risks;
use App\Models\Assessments;
use App\Models\Controls;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // === KPI METRICS ===
        $metrics = [
            'activeRisks' => Risks::where('status', 'active')->count(),
            'openAssessments' => Assessments::where('status', 'open')->count(),
            'controlsCoverage' => round(Controls::where('status', 'implemented')->count() / max(Controls::count(), 1) * 100, 1),
            'complianceScore' => DB::table('assessments')->avg('score') ?? 0,
        ];

        // === Risk Heatmap (impact vs likelihood) ===
        $heatmap = Risks::select('impact', 'likelihood', DB::raw('COUNT(*) as count'))
            ->groupBy('impact', 'likelihood')
            ->get()
            ->map(fn($r) => [
                'x' => $r->impact,
                'y' => $r->likelihood,
                'v' => $r->count,
            ]);

        // === Compliance Trend (last 6 months average score) ===
        $trend = DB::table('assessments')
            ->selectRaw('DATE_FORMAT(created_at, "%b") as month, AVG(score) as avg_score')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->get();

        // === Assessment Status Distribution ===
        $status = Assessments::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // === Recent Activity ===
        $activity = DB::table('activity_logs')
            ->select('event', 'entity', 'user', 'created_at')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('metrics', 'heatmap', 'trend', 'status', 'activity'));
    }
}
