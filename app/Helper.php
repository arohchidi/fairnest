<?php

namespace App;
use App\Models\Setting;

class Helper{
public static function formatNaira($value){

return "₦".$value;
}

public static function getLoginAttempts()
{
    return Setting::where('id', 1)
        ->value('max_login_attempts') ?? 5;
}

}


?>