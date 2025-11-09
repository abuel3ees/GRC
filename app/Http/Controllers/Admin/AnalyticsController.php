<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index()
    {
        // Example placeholder data — replace later with your real analytics queries
        $data = [
            'total_users' => \App\Models\User::count(),
            'total_assessments' => \App\Models\Assessments::count(),
            'active_risks' => \App\Models\Risks::where('status', 'active')->count(),
            'compliance_requirements' => \App\Models\ComplianceRequirement::count(),
        ];

        return view('admin.analytics.index', compact('data'));
    }
}
