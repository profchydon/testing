<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setNameAttribute($name) {
        $this->attributes['name'] = Crypt::encryptString($name);
    }

    public function setFirstNameAttribute($name) {
        $this->attributes['first_name'] = Crypt::encryptString($name);
    }

    public function setLastNameAttribute($name) {
        $this->attributes['last_name'] = Crypt::encryptString($name);
    }

    public function setPhoneAttribute($phone) {
        $this->attributes['phone'] = Crypt::encryptString($phone);
    }

    public function getNameAttribute()
    {
        return Crypt::decryptString($this->attributes['name']);
    }

    public function getFirstNameAttribute()
    {
        return Crypt::decryptString($this->attributes['first_name']);
    }

    public function getLastNameAttribute()
    {
        return Crypt::decryptString($this->attributes['last_name']);
    }

    public function getPhoneAttribute()
    {
        return Crypt::decryptString($this->attributes['phone']);
    }
}
