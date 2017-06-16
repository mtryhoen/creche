<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';
    //public $timestamps = false;
    //public $primaryKey = 'id';

    public function users(){
        return $this->belongsToMany('App\User', 'calendar_users');
    }

    public function usersdemi(){
        return $this->belongsToMany('App\User', 'calendardemi_users');
    }


}
