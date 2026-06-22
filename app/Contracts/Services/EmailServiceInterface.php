<?php

namespace App\Contracts\Services;

interface EmailServiceInterface
{
    public function sendToUsers(string $subject, string $content, array $options = []): array;
    public function sendToTenants(string $subject, string $content, array $options = []): array;
    public function sendToLandlords(string $subject, string $content, array $options = []): array;
    public function sendToIndividual(string $email, string $subject, string $content, array $options = []): bool;
    public function sendToMultiple(array $emails, string $subject, string $content, array $options = []): array;
    public function sendToRole(string $role, string $subject, string $content, array $options = []): array;
    public function sendCustom(array $recipients, string $subject, string $content, array $options = []): array;
}