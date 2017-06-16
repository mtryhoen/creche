<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Request;
use App\Calendar;
use App\User;
use App\calendar_users;
use App\calendardemi_user;
use DB;

class OccController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('formoccupation');
    }

    public function showcalendrier()
    {
        if ( Auth::check() && Auth::user()->isAdmin()){
            $user = Request::get('user');
        }else{
            $user = Auth::user()->id;
        }

        $month = Request::get('month');
        $year = Request::get('year');

        $matchThese = ['month' => $month, 'year' => $year];
        $dates = Calendar::where($matchThese)->get();
        $datesid = Calendar::where($matchThese)->pluck('id');

        //match journée complète
        $datescheckedcount=[];
        foreach ($datesid as $date){
        	$matchThese = ['calendar_id' => $date];
        	$dateschecked = calendar_users::where ($matchThese)->count();
    		$datescheckedcount [$date]= $dateschecked;
    	}
        //match demies journées
        $datescheckeddemicount=[];
        foreach ($datesid as $date){
        	$matchThese = ['calendar_id' => $date];
        	$dateschecked = calendardemi_user::where ($matchThese)->count();
    		$datescheckeddemicount [$date]= $dateschecked;
    	}

        return view ('occupationlist', compact('dates', 'datescheckedcount', 'datescheckeddemicount'));
        
    }
}

