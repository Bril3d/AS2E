<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Get the user's avatar.
     *
     * @param  string  $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        // Check if $value is null or empty
        if (!$value) {
            return '/storage/guest.png';
        }

        // Check if the avatar is synced from Provider
        if ($this->isAvatarSyncedFromProvider($value)) {
            // If synced from Provider, return the avatar as is
            return $value;
        }

        // If the avatar doesn't start with 'storage/', prepend it
        if (strpos($value, 'storage/') !== 0) {
            return '/storage/' . $value;
        }

        return $value;
    }

    /**
     * Check if the user's avatar is synced from Provider.
     *
     * @return bool
     */
    protected function isAvatarSyncedFromProvider($value)
    {
        if (strpos($value, 'avatars/') !== 0) {
            return true;
        }
        return false;
    }

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    /**
     * Get all of the socials for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials(): HasMany
    {
        return $this->hasMany(Social::class);
    }


    /**
     * Get all of the appointment for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isLeader()
    {
        return $this->hasRole(['admin', 'moderator']);
    }
}
