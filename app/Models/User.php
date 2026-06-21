<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ["name", "email", "password", "avatar", "is_admin", "banned_at"];

    protected $hidden = ["password", "remember_token"];

    public function isBanned(): bool
    {
        return $this->banned_at !== null;
    }
    /**
     * @return HasMany<Writeup,User>
     */
    public function writeups(): HasMany
    {
        return $this->hasMany(Writeup::class);
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? asset("storage/" . $this->avatar) : "";
    }

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "banned_at" => "datetime",
            "password" => "hashed",
        ];
    }
}
