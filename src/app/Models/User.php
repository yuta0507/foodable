<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Table relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    /**
     * Delete related restaurants when deleting a user.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function ($user) {
            $user->restaurants()->delete();
        });
    }
}
