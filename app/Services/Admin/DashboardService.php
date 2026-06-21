<?php

namespace App\Services\Admin;

use App\Contracts\Services\DashboardServiceInterface;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService implements DashboardServiceInterface
{
    public function getStatistics(): array
    {
        return [
            'total_properties' => Property::count(),
            'active_bookings' =>  Booking::where('status', 'confirmed')->count(),
            'total_users' => User::count(),
            'active_users' => User::where('is_active', 1)->count(),
            'in_active_users' => User::where('is_active', 0)->count(),
            'total_revenue' => 0,
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
            
            'average_rating' =>  0,
        ];
    }

    public function getRecentBookings(int $limit = 5): array
    {
        return Booking::with(['property'])
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'guest_name' => $booking->username  ?? 'Guest',
                    
                    'property_title' => $booking->property->title ?? 'N/A',
                    'property_image' => $booking->property->images,
                    'booking_date' => $booking->booking_date,
                    
                    'status' => $booking->status,
                    'status_color' => $this->getStatusColor($booking->status),
                    
                ];
            })
            ->toArray();
    }

    public function getRevenueData(): array
    {
        $revenueByMonth = Booking::where('status', 'confirmed')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                //DB::raw('SUM() as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($revenueByMonth as $item) {
            $labels[] = Carbon::create()->month($item->month)->format('M') . ' ' . $item->year;
            $data[] = $item->total;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function getBookingTrends(): array
    {
        $bookingsByMonth = Booking::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($bookingsByMonth as $item) {
            $labels[] = Carbon::create()->month($item->month)->format('M');
            $data[] = $item->total;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function getTopProperties(int $limit = 5): array
    {
        return Property::withCount('bookings')
           
           ->orderBy('bookings_count', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'image' => $property->featured_image,
                    'location' => $property->city . ', ' . $property->country,
                    'rent' => $property->rent_fee,
                    'total_bookings' => $property->bookings_count,
                    'rating' => round($property->reviews_avg_rating ?? 0, 1),
                ];
            })
            ->toArray();
    }

    

    private function getStatusColor(string $status): string
    {
        return match ($status) {
            'confirmed' => 'green',
            'pending' => 'yellow',
            'cancelled' => 'red',
            'completed' => 'blue',
            default => 'gray',
        };
    }
}