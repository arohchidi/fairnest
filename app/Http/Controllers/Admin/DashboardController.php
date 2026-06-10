<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Services\DashboardServiceInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected DashboardServiceInterface $dashboardService;

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(): View
    {
        $statistics = $this->dashboardService->getStatistics();
        $recentBookings = $this->dashboardService->getRecentBookings();
        $revenueData = $this->dashboardService->getRevenueData();
        $bookingTrends = $this->dashboardService->getBookingTrends();
        $topProperties = $this->dashboardService->getTopProperties();

        return view('admin.dashboard.index', compact(
            'statistics',
            'recentBookings',
            'revenueData',
            'bookingTrends',
            'topProperties'
        ));
    }
}