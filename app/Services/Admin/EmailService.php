<?php

namespace App\Services\Admin;

use App\Contracts\Services\EmailServiceInterface;
use App\Models\User;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmailService implements EmailServiceInterface
{
    protected array $results = [];
    protected int $successCount = 0;
    protected int $failureCount = 0;
    protected array $failedEmails = [];

    
     //Send email to all users
     
    public function sendToUsers(string $subject, string $content, array $options = []): array
    {
        $users = User::where('is_active', true)->get();
        return $this->sendBulk($users, $subject, $content, $options);
    }

    // Send email to all tenants
     
    public function sendToTenants(string $subject, string $content, array $options = []): array
    {
        $users = User::where('role', 'tenant')
            ->where('is_active', true)
            ->get();
        return $this->sendBulk($users, $subject, $content, $options);
    }

    //Send email to all landlords
     
    public function sendToLandlords(string $subject, string $content, array $options = []): array
    {
        $users = User::where('role', 'landlord')
            ->where('is_active', true)
            ->get();
        return $this->sendBulk($users, $subject, $content, $options);
    }

    //send email to inidiviual
    public function sendToIndividual(string $email, string $subject, string $content, array $options = []): bool
    {
        try {
            Mail::to($email)->queue(new CustomMail($subject, $content, $options));
            return true;
        } catch (\Exception $e) {
            Log::error('Individual email failed: ' . $e->getMessage(), ['email' => $email]);
            return false;
        }
    }

    
      //Send email to multiple specific email addresses
     
    public function sendToMultiple(array $emails, string $subject, string $content, array $options = []): array
    {
        $this->resetCounters();

        foreach ($emails as $email) {
            if ($this->isValidEmail($email)) {
                try {
                    Mail::to($email)->queue(new CustomMail($subject, $content, $options));
                    $this->successCount++;
                } catch (\Exception $e) {
                    $this->failureCount++;
                    $this->failedEmails[] = $email;
                    Log::error('Multiple email failed: ' . $e->getMessage(), ['email' => $email]);
                }
            } else {
                $this->failureCount++;
                $this->failedEmails[] = $email;
                Log::warning('Invalid email address skipped', ['email' => $email]);
            }
        }

        return $this->getResult();
    }

    // Send email to users by role
     
    public function sendToRole(string $role, string $subject, string $content, array $options = []): array
    {
        $users = User::where('role', $role)
            ->where('is_active', true)
            ->get();
        return $this->sendBulk($users, $subject, $content, $options);
    }

    
     //Send custom email to any recipients array
    
    public function sendCustom(array $recipients, string $subject, string $content, array $options = []): array
    {
        $this->resetCounters();

        // Handle different recipient types
        foreach ($recipients as $recipient) {
            $email = $this->extractEmail($recipient);
            
            if ($this->isValidEmail($email)) {
                try {
                    $user = $this->findUserByEmail($email);
                    $mailOptions = array_merge($options, ['user' => $user]);
                    Mail::to($email)->queue(new CustomMail($subject, $content, $mailOptions));
                    $this->successCount++;
                } catch (\Exception $e) {
                    $this->failureCount++;
                    $this->failedEmails[] = $email;
                    Log::error('Custom email failed: ' . $e->getMessage(), ['email' => $email]);
                }
            } else {
                $this->failureCount++;
                $this->failedEmails[] = $email;
                Log::warning('Invalid custom email address', ['email' => $email]);
            }
        }

        return $this->getResult();
    }

    //Send bulk email to collection of users
     
    protected function sendBulk($users, string $subject, string $content, array $options = []): array
    {
        $this->resetCounters();

        foreach ($users as $user) {
            try {
                $mailOptions = array_merge($options, ['user' => $user]);
                Mail::to($user->email)->queue(new CustomMail($subject, $content, $mailOptions));
                $this->successCount++;
            } catch (\Exception $e) {
                $this->failureCount++;
                $this->failedEmails[] = $user->email;
                Log::error('Bulk email failed: ' . $e->getMessage(), ['user_id' => $user->id, 'email' => $user->email]);
            }
        }

        return $this->getResult();
    }

    
     //Extract email from various formats
     
    protected function extractEmail($recipient): string
    {
        if (is_string($recipient)) {
            return $recipient;
        }

        if (is_array($recipient)) {
            return $recipient['email'] ?? $recipient['address'] ?? '';
        }

        if (is_object($recipient) && isset($recipient->email)) {
            return $recipient->email;
        }

        return '';
    }

    
     // Find user by email
    
    protected function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    //Validate email address
     
    protected function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    //Reset counters
    
    protected function resetCounters(): void
    {
        $this->successCount = 0;
        $this->failureCount = 0;
        $this->failedEmails = [];
    }

    //Get result summary
    
    protected function getResult(): array
    {
        return [
            'success' => $this->successCount > 0 && $this->failureCount === 0,
            'success_count' => $this->successCount,
            'failure_count' => $this->failureCount,
            'failed_emails' => $this->failedEmails,
            'total' => $this->successCount + $this->failureCount,
            'message' => $this->getResultMessage(),
        ];
    }

    
     //Get result message
    
    protected function getResultMessage(): string
    {
        if ($this->successCount > 0 && $this->failureCount === 0) {
            return "All emails sent successfully! ({$this->successCount} emails)";
        }

        if ($this->successCount > 0 && $this->failureCount > 0) {
            return "{$this->successCount} emails sent, {$this->failureCount} failed.";
        }

        return "All emails failed to send. Please check logs for details.";
    }
}