<?php

namespace App\Http\Controllers\Admin;


use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;



class RegisterController extends Controller
{
    protected $authService;
    protected $settings;

    public function __construct(AuthService $authService, Setting $settings)
    {
        $this->authService = $authService;
        $this->settings = Setting::first();
    }

    

    // Show register form
    public function index(): View
    {
        return view('admin.auth.register');
    }

    // Handle register
   public function register(RegisterRequest $request): RedirectResponse
    {

    
        try {
            // Use all request input if a FormRequest is not available
            $user = $this->authService->register($request->validated());

            // Auto login after registration
            $this->authService->login(
                $request->only('email', 'password')
            );

            //send welcome email 
            Mail::to($user->email)
            ->queue(new WelcomeMail(
                    $user,
                    $this->settings->welcome_email,
                    $this->settings->welcome_subject
                )
            );

            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome to ' . config('app.name') . '!');

        } catch (\Exception $e) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', $e->getMessage());
        }
    }

/*public function register(Request $request)
{
    Log::info('Register method reached', $request->all());
    return redirect()->back()->with('error', 'Test');
}
    
*/

    
   
}