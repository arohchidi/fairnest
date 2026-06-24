<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     $maintenance = Setting::where('id', 1)->value('maintenance_mode') ?? 0;
     $returnDate  =  Setting::where('id', 1)->value('maintenance_return_time') ?? 0;

     //allow admin routes
     if ($request->is('admin/*') || $request->is('admin')) {
            return $next($request);
        }
        if($maintenance == 1){
            return response()->view('maintenance', ['returnDate' => $returnDate], 503);
        }

        return $next($request);
    }
}
