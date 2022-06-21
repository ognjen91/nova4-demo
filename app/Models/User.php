<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Nova\Auth\Impersonatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Impersonatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'city_id',
        'email_sent'
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
     * RELATIONSHIPS
     */

     public function city(){
        return $this->belongsTo(City::class);
     }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['role'] == 'admin',
        );
    }
    


        /**
         * Determine if the user can impersonate another user.
         *
         * @return bool
         */
        public function canImpersonate()
        {
            return $this->isAdmin;
        }

        /**
         * Determine if the user can be impersonated.
         *
         * @return bool
         */
        public function canBeImpersonated()
        {
            return !$this->isAdmin;

        }


}
