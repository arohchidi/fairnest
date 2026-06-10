<?php

namespace App\Contracts\Services;

interface DashboardServiceInterface
{
    public function getStatistics(): array;
    public function getRecentBookings(int $limit = 5): array;
    public function getRevenueData(): array;
    public function getBookingTrends(): array;
    public function getTopProperties(int $limit = 5): array;
}