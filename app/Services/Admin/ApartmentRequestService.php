<?php

namespace App\Services\Admin;

use App\Contracts\Services\ApartmentRequestServiceInterface;
use App\Models\ApartmentRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class ApartmentRequestService implements ApartmentRequestServiceInterface
{
    public function submitRequest(array $data)
    {
        // Convert requirements array to JSON
        if (isset($data['requirements'])) {
            $data['requirements'] = json_encode($data['requirements']);
        }
        
        return ApartmentRequest::create($data);
    }

    public function getFilteredRequests(array $filters): LengthAwarePaginator
    {
        $query = ApartmentRequest::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['location'])) {
            $query->where('preferred_location', $filters['location']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        return $query->latest()->paginate(15);
    }

    public function updateStatus(int $id, string $status, ?string $adminNote = null)
    {
        $request = ApartmentRequest::findOrFail($id);
        $request->update([
            'status' => $status,
            'admin_note' => $adminNote,
        ]);
        return $request;
    }

    public function deleteRequest(int $id): bool
    {
        $request = ApartmentRequest::findOrFail($id);
        return $request->delete();
    }

    public function getStatistics(): array
    {
        return [
            'total' => ApartmentRequest::count(),
            'pending' => ApartmentRequest::where('status', 'pending')->count(),
            'in_progress' => ApartmentRequest::where('status', 'in_progress')->count(),
            'resolved' => ApartmentRequest::where('status', 'resolved')->count(),
        ];
    }

    public function getRequestById(int $id)
    {
        return ApartmentRequest::findOrFail($id);
    }
}