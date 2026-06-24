<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Admin\RoommateMatchingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchingController extends Controller
{
    protected  $matchingService;

    public function __construct(RoommateMatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }

    public function index(Request $request): View
    {
        // Get all potential matches
        $matches = $this->matchingService->getPotentialMatches();
        
        // Get statistics
        $statistics = $this->matchingService->getStatistics();

        // Paginate results
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $paginatedMatches = new \Illuminate\Pagination\LengthAwarePaginator(
            $matches->forPage($currentPage, $perPage),
            $matches->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.matching.index', [
            'matches' => $paginatedMatches,
            'statistics' => $statistics,
        ]);
    }

    public function connect(Request $request)
    {
        $validated = $request->validate([
            'booking1_id' => 'required|exists:bookings,id',
            'booking2_id' => 'required|exists:bookings,id',
            'message' => 'nullable|string',
        ]);

        // Create connection or send notification
        // You can create a RoommateConnection model here

        return redirect()->route('admin.matching.index')
            ->with('success', 'Roommates connected successfully!');
    }
}