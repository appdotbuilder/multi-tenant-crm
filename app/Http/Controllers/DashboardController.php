<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the CRM dashboard.
     */
    public function index()
    {
        // Basic counts
        $totalCompanies = Company::count();
        $totalContacts = Contact::count();
        $totalDeals = Deal::count();
        $totalLeads = Lead::count();
        $overdueTasks = Task::overdue()->count();

        // Revenue metrics
        $totalRevenue = Deal::where('stage', 'closed_won')->sum('value');
        $pipelineValue = Deal::whereNotIn('stage', ['closed_won', 'closed_lost'])->sum('value');
        $avgDealValue = Deal::avg('value') ?: 0;

        // Recent activity
        $recentDeals = Deal::with(['company', 'contact'])
            ->latest()
            ->limit(5)
            ->get();

        $upcomingTasks = Task::with(['assignedUser', 'taskable'])
            ->where('due_date', '>=', now())
            ->where('status', 'pending')
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        // Deal stages breakdown
        $dealsByStage = Deal::select('stage', DB::raw('count(*) as count'), DB::raw('sum(value) as total_value'))
            ->groupBy('stage')
            ->get();

        // Lead sources breakdown
        $leadsBySource = Lead::select('source', DB::raw('count(*) as count'))
            ->groupBy('source')
            ->get();

        return Inertia::render('dashboard', [
            'metrics' => [
                'totalCompanies' => $totalCompanies,
                'totalContacts' => $totalContacts,
                'totalDeals' => $totalDeals,
                'totalLeads' => $totalLeads,
                'overdueTasks' => $overdueTasks,
                'totalRevenue' => $totalRevenue,
                'pipelineValue' => $pipelineValue,
                'avgDealValue' => $avgDealValue,
            ],
            'recentDeals' => $recentDeals,
            'upcomingTasks' => $upcomingTasks,
            'dealsByStage' => $dealsByStage,
            'leadsBySource' => $leadsBySource,
        ]);
    }
}