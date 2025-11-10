<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardTestSeeder extends Seeder
{
    public function run()
    {
    

        // === ASSESSMENTS ===
        DB::table('assessments')->insert([
            ['title' => 'Q1 Audit', 'status' => 'Draft', 'score' => 82, 'created_at' => Carbon::now()->subMonths(1), 'updated_at' => now()],
            ['title' => 'Q2 Audit', 'status' => 'Active', 'score' => 88, 'created_at' => Carbon::now()->subMonths(2), 'updated_at' => now()],
            ['title' => 'Internal Review', 'status' => 'Closed', 'score' => 76, 'created_at' => Carbon::now()->subMonths(3), 'updated_at' => now()],
    ]);

        // === CONTROLS ===
        DB::table('controls')->insert([
            ['title' => 'Firewall Installed', 'status' => 'implemented', 'created_at' => now(), 'updated_at' => now(), 'control_code' => 'CTRL-001'],
            ['title' => 'Backup Policy', 'status' => 'implemented', 'created_at' => now(), 'updated_at' => now(), 'control_code' => 'CTRL-002'],
            ['title' => 'Encryption', 'status' => 'implemented', 'created_at' => now(), 'updated_at' => now(), 'control_code' => 'CTRL-003'],
            ['title' => 'Access Control', 'status' => 'implemented', 'created_at' => now(), 'updated_at' => now(), 'control_code' => 'CTRL-004'],
        ]);

        // === ACTIVITY LOGS ===
        DB::table('activity_logs')->insert([
            ['event' => 'Risk Added', 'entity' => 'Risks', 'user' => 'Admin', 'created_at' => now()],
            ['event' => 'Assessment Completed', 'entity' => 'Assessments', 'user' => 'Admin', 'created_at' => now()],
        ]);
    }
}
