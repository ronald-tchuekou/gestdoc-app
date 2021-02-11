<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personne_id',
        'login',
        'password',
        'role',
        'service_id',
        'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fonction that return the information of this user.
     */
    public function personne () {
        return $this->belongsTo(Personne::class);
    }

    /**
     * Function that return the service of this user.
     */
    public function service () {
        return $this->belongsTo(Service::class);

    }

    public function couriers_initialises () {
        return $this->hasMany(Courier::class);
    }

    public function couriers_assignes () {
        return $this->belongsToMany(Courier::class, 'assignes');
    }
}
