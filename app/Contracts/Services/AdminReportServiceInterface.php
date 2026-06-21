<?php
namespace App\Contracts\Services;
use App\Models\Report;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminReportServiceInterface
{
    public function reports():array;
    public function destroy(int $id);
    public function toggleStatus(int $id, string $data):Report;
    public function show(int $id):Report;
}






?>