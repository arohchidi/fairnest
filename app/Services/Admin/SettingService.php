<?php
namespace  App\Services\Admin;
use App\Models\Setting;

use App\Contracts\Services\SettingServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Override;

class SettingService implements SettingServiceInterface
{
    protected $settingModel;

    public function __construct(Setting $setting){
        $this->settingModel = $setting;
    }


    #[Override]
    public function settings(): ?Setting
    {
       return  $this->settingModel->first();
    }



    public function store(array $data): ?Setting
    {
       
      $settings =  $this->settingModel->firstOrCreate([]);

       $settings->fill($data)->save();
       return  $settings->refresh();
       

    }
}