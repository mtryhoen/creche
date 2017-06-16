<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'username', 'fullname', 'tariffull', 'tarifhalf',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function calendars(){
        return $this->belongsToMany('App\Calendar', 'calendar_users');
    }
    public function calendarsdemi(){
        return $this->belongsToMany('App\Calendar', 'calendardemi_users');
    }

    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }
}
