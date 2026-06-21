<?php

namespace App\Contracts\Services;
use App\Models\Setting;
interface SettingServiceInterface{

public function settings(): ?Setting;
public function store(array $data): ?Setting;
}

?>