<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'email_verified_at',
        'role', // admin, landlord, tenant
        'phone',
        'avatar',
        'is_active',
        'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function sendPasswordResetNotification($token)
{
    $this->notify(
        new ResetPasswordNotification($token)
    );
}



    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is landlord
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    /**
     * Check if user is tenant
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get user's properties (if landlord)
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get user's bookings (if tenant)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}