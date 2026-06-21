<?php

namespace App\Contracts\Services;
use App\Models\Review;
interface ReviewServiceInterface{

public function store(array $data, int $id):Review;
}

?>