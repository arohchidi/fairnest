<?php

namespace App\Contracts\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface ApartmentRequestServiceInterface
{
    public function submitRequest(array $data);
    public function getFilteredRequests(array $filters): LengthAwarePaginator;
    public function updateStatus(int $id, string $status, ?string $adminNote = null);
    public function deleteRequest(int $id): bool;
    public function getStatistics(): array;
    public function getRequestById(int $id);
}