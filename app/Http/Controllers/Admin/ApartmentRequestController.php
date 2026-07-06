<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Services\ApartmentRequestServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApartmentRequestController extends Controller
{
    protected ApartmentRequestServiceInterface $service;

    public function __construct(ApartmentRequestServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'status', 'location', 'date_from']);
        $requests = $this->service->getFilteredRequests($filters);
        $statistics = $this->service->getStatistics();

        return view('admin.apartment-requests.index', compact('requests', 'statistics'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'admin_note' => 'nullable|string',
        ]);

        try {
            $this->service->updateStatus($id, $validated['status'], $validated['admin_note'] ?? null);
            
            return redirect()
                ->route('admin.apartment-requests.index')
                ->with('success', 'Request status updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->deleteRequest($id);
            
            return redirect()
                ->route('admin.apartment-requests.index')
                ->with('success', 'Request deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete request.');
        }
    }
}