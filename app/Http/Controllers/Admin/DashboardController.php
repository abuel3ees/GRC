<?php

namespace App\Http\Controllers\Admin;

use App\Models\CyberRisk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
       public function index()
{
    // === Fetch Cyber Risks for Scatter Plot ===
    $heatmap = CyberRisk::select('impact', 'likelihood', 'title', 'code', 'residual_level')
        ->get()
        ->map(fn($r) => [
            'x' => (int)$r->impact,
            'y' => (int)$r->likelihood,
            'label' => "{$r->code} - {$r->title}",
            'residual_level' => $r->residual_level,
        ]);


        // === 2️⃣ Compliance trend dummy (replace later if you have audits table) ===
        $trend = collect([
            ['month' => 'Jan', 'avg_score' => 70],
            ['month' => 'Feb', 'avg_score' => 75],
            ['month' => 'Mar', 'avg_score' => 80],
            ['month' => 'Apr', 'avg_score' => 82],
            ['month' => 'May', 'avg_score' => 85],
        ]);

        // === 3️⃣ Assessment status dummy ===
        $status = [
            'Open' => 8,
            'In Progress' => 4,
            'Mitigated' => 6,
            'Closed' => 2,
        ];

        // === 4️⃣ KPIs ===
        $metrics = [
            'activeRisks' => CyberRisk::count(),
            'openAssessments' => 10, // placeholder
            'controlsCoverage' => 76, // placeholder %
            'complianceScore' => 84.3, // placeholder %
        ];

        // === 5️⃣ Activity logs optional ===
        $activity = collect([]);

        return view('admin.dashboard', compact('heatmap', 'trend', 'status', 'metrics', 'activity'));
    }
}
