<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $fullpathimg = "";
    
   // protected $appends = ['path'=>'1.jpg'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email', 
        'mobile', 
        'password', 
        'email_verified_at', 
       
'first_name',
'last_name',
'user_name',
'role',
'token',
'mobile',
'createuser_id',
'updateuser_id',
'image',
'is_active',
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

    public function createusers(): HasMany
    {
        return $this->hasMany(User::class,'createuser_id');
    }

    public function createruser(): BelongsTo
    {
        return $this->belongsTo(User::class,'createuser_id')->withDefault();
    }
    //
    public function updateusers(): HasMany
    {
        return $this->hasMany(User::class,'updateuser_id');
    }

    public function updateruser(): BelongsTo
    {
        return $this->belongsTo(User::class,'updateuser_id')->withDefault();
    }
    //
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
    public function notificationUsers(): HasMany
    {
        return $this->hasMany(NotificationUser::class);
    }
    public function selectedservices(): HasMany
    {
        return $this->hasMany(Selectedservice::class,'comment_user_id');
    }
}
