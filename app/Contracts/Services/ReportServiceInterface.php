<?php

namespace App\Contracts\Services;
use App\Models\Report;
interface ReportServiceInterface{


public function storeReport(array $data, int $id): ?Report;
}

?>