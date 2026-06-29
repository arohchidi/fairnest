<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;


use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Show login form
    public function index(): View
    {
        return view('admin.auth.login');
    }

    // Handle login
    public function login(LoginRequest $request): RedirectResponse
    {
    $ip = FacadesRequest::ip();
       
    
        try {
            $user = $this->authService->login(
                $request->all('email', 'password'), $ip);
 Log::info($request->all()); 
            return redirect()->to('admin/dashboard')
    ->with('success', 'Welcome back');

        } catch (\Exception $e) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->with('error', $e->getMessage());
        }
    }

  
    // Handle logout
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}