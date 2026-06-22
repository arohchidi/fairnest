<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Services\EmailServiceInterface;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailController extends Controller
{
    protected EmailServiceInterface $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Show email compose form
     */
    public function index(): View
    {
        return view('admin.email.send');
    }

    /**
     * Send email(s)
     */
    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_type' => 'required|in:all_users,tenants,landlords,specific',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'specific_recipients' => 'nullable|required_if:recipient_type,specific|string',
            'send_copy' => 'nullable|boolean',
        ]);

        $recipientType = $validated['recipient_type'];
        $subject = $validated['subject'];
        $content = $validated['content'];
        $options = ['send_copy' => $request->has('send_copy')];

        // Send based on recipient type
        $result = match ($recipientType) {
            'all_users' => $this->emailService->sendToUsers($subject, $content, $options),
            'tenants' => $this->emailService->sendToRole('tenant', $subject, $content, $options),
            'landlords' => $this->emailService->sendToRole('landlord', $subject, $content, $options),
            'specific' => $this->sendToSpecific($validated['specific_recipients'], $subject, $content, $options),
            default => ['success' => false, 'message' => 'Invalid recipient type'],
        };

        if ($request->has('send_copy')) {
            $this->emailService->sendToIndividual(Auth::user()->email, 'Copy: ' . $subject, $content, $options);
        }

        return redirect()
            ->route('admin.email.index')
            ->with('email_result', $result);
    }

    /**
     * Send to specific email addresses
     */
    protected function sendToSpecific(string $recipients, string $subject, string $content, array $options): array
    {
        $emails = array_map('trim', explode(',', $recipients));
        $emails = array_filter($emails);

        if (count($emails) === 1) {
            $success = $this->emailService->sendToIndividual($emails[0], $subject, $content, $options);
            return [
                'success' => $success,
                'success_count' => $success ? 1 : 0,
                'failure_count' => $success ? 0 : 1,
                'failed_emails' => $success ? [] : $emails,
                'total' => 1,
                'message' => $success ? 'Email sent successfully!' : 'Failed to send email.',
            ];
        }

        return $this->emailService->sendToMultiple($emails, $subject, $content, $options);
    }

    /**
     * Get recipient preview for compose form
     */
    public function previewRecipients(Request $request): View
    {
        $type = $request->input('type', 'all_users');
        $count = 0;
        $preview = [];

        switch ($type) {
            case 'all_users':
                $users = User::where('is_active', true)->latest()->limit(10)->get();
                $count = User::where('is_active', true)->count();
                $preview = $users;
                break;
            case 'tenants':
                $users = User::where('role', 'tenant')->where('is_active', true)->latest()->limit(10)->get();
                $count = User::where('role', 'tenant')->where('is_active', true)->count();
                $preview = $users;
                break;
            case 'landlords':
                $users = User::where('role', 'landlord')->where('is_active', true)->latest()->limit(10)->get();
                $count = User::where('role', 'landlord')->where('is_active', true)->count();
                $preview = $users;
                break;
            case 'specific':
                $emails = array_map('trim', explode(',', $request->input('emails', '')));
                $preview = array_filter($emails);
                $count = count($preview);
                break;
        }

        return view('admin.email.preview', compact('type', 'count', 'preview'));
    }
}