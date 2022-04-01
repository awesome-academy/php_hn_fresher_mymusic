<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const USER_UNACTIVE = 0;
    const USER_ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'avatar',
        'password',
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
    ];

    public $appends = [
        'avatar_full_path',
        'full_name',
        'role_description',
        'active_description',
    ];

    public function getAvatarFullPathAttribute()
    {
        return env('APP_URL') . '/' . $this->attributes['avatar'];
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isActive()
    {
        return $this->active === self::USER_ACTIVE;
    }

    public function scopeAdmin(Builder $builder)
    {
        return $builder->where('role', User::ROLE_ADMIN);
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('active', User::USER_ACTIVE);
    }

    public function getRoleDescriptionAttribute()
    {
        return __('common.role.' . $this->attributes['role']);
    }

    public function getActiveDescriptionAttribute()
    {
        return __('common.active.' . $this->attributes['active']);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)
            ->format(config('admin.format.datetime'));
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->attributes['updated_at'] = Carbon::parse($value)
            ->format(config('admin.format.datetime'));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
}
