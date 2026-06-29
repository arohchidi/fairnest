<?php
namespace App\Contracts\Services;
interface AuthServiceInterface
{
    public function register(array $data);
    public function login(array $credentials, $ip);
    public function logout();
    public function  sendPasswordResetLink(string $email);
    public function resetPassword(array $data);
}






?>