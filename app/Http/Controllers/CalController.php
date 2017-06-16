<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades;
//use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Request;
use App\Calendar;
use App\User;
use App\calendar_users;
use App\calendardemi_user;
use DB;


class CalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendrier()
    {
        return view ('formcalendrier');
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
        $matchThese2 = ['user_id' => $user];
        $dateschecked = calendar_users::where ($matchThese2)->get();
        //match demies journées
        $matchThesedemi = ['user_id' => $user];
        $datescheckeddemi = calendardemi_user::where ($matchThesedemi)->get();
        
        return view ('calendrierlist', compact('dates', 'dateschecked', 'datescheckeddemi', 'datesid', 'user'));
        
    }

    public function showcalendrieradmin()
    {
        $user = Auth::user()->id;
        if ( Auth::check() && Auth::user()->isAdmin()){
            $user = User::lists('fullname','id');
        }

        $month = Request::get('month');
        $year = Request::get('year');

        $matchThese = ['month' => $month, 'year' => $year];
        $dates = Calendar::where($matchThese)->get();
        $datesid = Calendar::where($matchThese)->pluck('id');
        //dd($datesid);
        //match journées complètes
        $matchThese2 = ['user_id' => $user];
        $dateschecked = calendar_users::where ($matchThese2)->get();

        //match journées complètes
        $matchThesedemi = ['user_id' => $user];
        $datescheckeddemi = calendardemi_user::where ($matchThesedemi)->get();

        return view ('formcalendrier', compact('user'));
        
    }

    public function createcalendrier($colname)
    {
        Schema::table('calendars', function($table) use ($colname)
            {
                //$table->string($colname, 30);
            });
        return view ('calendrier');
    }

    public function savecalendrier()
    {
        if ( Auth::check() && Auth::user()->isAdmin()){
            $userid = Request::get('user');
        }else{
            $userid = Auth::user()->id;
        }
        $datesid = Request::get('datesid');
        $datesarraydemi = Request::get('dateiddemi');
        $datesarray=Request::get('dateid');

        $user=User::find($userid);

        //save journées complètes
        $user->calendars()->detach($datesid);
        $user->calendars()->attach($datesarray);
        //save demies journées
        $user->calendarsdemi()->detach($datesid);
        $user->calendarsdemi()->attach($datesarraydemi);

        $user = Auth::user()->id;

        //return view ('formcalendrier', compact('user'));
        return redirect('calendrier');
    }

    public function deletecalendrier()
    {
        
    }
    
}
