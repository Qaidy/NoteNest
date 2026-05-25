<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userId = auth()->id();
        
        // Cache total notes count for 1 hour, invalidated when note changes
        $totalNotes = Cache::remember("user.{$userId}.notes_count", 3600, function () use ($userId) {
            return auth()->user()->notes()->count();
        });

        // Fetch recent notes directly (fast with index, avoids Collection serialization issues)
        $recentNotes = auth()->user()->notes()->latest()->take(3)->get();

        return view('dashboard', compact('totalNotes', 'recentNotes'));
    }
}
