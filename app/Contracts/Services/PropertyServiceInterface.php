<?php

namespace App\Contracts\Services;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;


use Illuminate\Pagination\LengthAwarePaginator;

interface PropertyServiceInterface
{
    public function createProperty(array $data);
    public function getProperties(): array;
    public function getFilteredProperties(array $filters): LengthAwarePaginator;
    public function getPropertyById(int $id);
    public function updateProperty(int $id, array $data);
    public function deleteProperty(int $id);
    public function featuredProperties():Collection;
    public function latestProperties():Collection;


}
  