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
            'active_bookings' => 0,
            'total_users' => User::count(),
            'total_revenue' => 0,
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
            'occupancy_rate' => $this->calculateOccupancyRate(),
            'average_rating' =>  0,
        ];
    }

    public function getRecentBookings(int $limit = 5): array
    {
        return Booking::with(['user', 'property'])
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'guest_name' => $booking->user->name ?? $booking->user->username ?? 'Guest',
                    'guest_avatar' => $booking->user->avatar,
                    'property_title' => $booking->property->title ?? 'N/A',
                    'property_image' => $booking->property->featured_image,
                    'check_in' => $booking->check_in->format('M d, Y'),
                    'check_out' => $booking->check_out->format('M d, Y'),
                    'status' => $booking->status,
                    'status_color' => $this->getStatusColor($booking->status),
                    'total_price' => $booking->total_price,
                    'nights' => $booking->check_in->diffInDays($booking->check_out),
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
            //->withAvg('reviews', 'rating')
           // ->orderBy('bookings_count', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'image' => $property->featured_image,
                    'location' => $property->city . ', ' . $property->country,
                    'price_per_night' => $property->price_per_night,
                    'total_bookings' => $property->bookings_count,
                    'rating' => round($property->reviews_avg_rating ?? 0, 1),
                ];
            })
            ->toArray();
    }

    private function calculateOccupancyRate(): float
    {
        $totalProperties = Property::count();
        if ($totalProperties === 0) return 0;

        $today = Carbon::today();
        $occupiedBookings = Booking::where('status', 'confirmed')
            ->where('check_in', '<=', $today)
            ->where('check_out', '>=', $today)
            ->distinct('property_id')
            ->count('property_id');

        return round(($occupiedBookings / $totalProperties) * 100, 1);
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