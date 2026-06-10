<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Contracts\Services\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

   
    // Show forgot password form
    public function showForgotForm(): View
    {
        return view('admin.auth.forgot-password');
    }

    // Handle forgot password
    public function sendResetLink(ForgotPasswordRequest $request): RedirectResponse
    {
        try {
            $message = $this->authService->sendPasswordResetLink($request->email);

            return back()
                ->with('status', $message);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    // Show reset password form
    public function showResetForm(string $token): View
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        try {
            $message = $this->authService->resetPassword($request->validated());

            return redirect()->route('admin.login')
                ->with('success', 'Password reset successful. Please login with your new password.');

        } catch (\Exception $e) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', $e->getMessage());
        }
    }

   
}