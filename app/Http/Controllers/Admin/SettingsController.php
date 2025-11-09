<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    /**
     * Display system settings page.
     */
    public function index()
    {
        $settings = [
            'app_name'   => config('app.name'),
            'app_env'    => config('app.env'),
            'app_debug'  => config('app.debug'),
            'timezone'   => config('app.timezone'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Handle a settings update request.
     */
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
        ]);

        // In production, you'd persist these in DB or .env
        Config::set('app.name', $request->input('app_name'));

        return back()->with('success', 'Settings updated successfully!');
    }
}
