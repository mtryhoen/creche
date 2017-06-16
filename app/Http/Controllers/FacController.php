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

class FacController extends Controller
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

    public function facturation()
    {
        if ( Auth::check() && Auth::user()->isAdmin()){
            $user = User::lists('fullname','id');
        }
        return view ('formfacturation', compact('user'));
    }

    public function showfacturation()
    {
        if ( Auth::check() && Auth::user()->isAdmin()){
            $user = Request::get('user');
        }else{
            $user = Auth::user()->id;
        }
        $matchThese = ['id' => $user];
        //dd($user);
        //$fullname = Auth::user()->fullname;
        $fullname = User::where($matchThese)->pluck('fullname');
        $fullname = $fullname[0];
        $tariffull = User::where($matchThese)->pluck('tariffull');
        $tariffull = $tariffull[0];
        $tarifhalf = User::where($matchThese)->pluck('tarifhalf');
        $tarifhalf = $tarifhalf[0];
        //dd($tariffull);
        $month = Request::get('month');
        $year = Request::get('year');
        
        $matchThese = ['month' => $month, 'year' => $year];
        $dates = Calendar::where($matchThese)->get();
        $datesid = Calendar::where($matchThese)->pluck('id');
        $datecountAM = Calendar::wherehas('users', function($q) use ($datesid, $user){
            $q->wherein('calendar_id', $datesid)->where('user_id', $user);
        })->count();        
        //dd($datecount);
        $datecountPM = Calendar::wherehas('usersdemi', function($q) use ($datesid, $user){
            $q->wherein('calendar_id', $datesid)->where('user_id', $user);
        })->count();
        $datetot = $datecountPM + $datecountAM;
        $dateAMPM = 0;

        foreach ($datesid as $date){
            $matchThese = ['user_id' => $user, 'calendar_id' => $date];
            $datescheckedAM = calendar_users::where ($matchThese)->count();
            $datescheckedPM = calendardemi_user::where ($matchThese)->count();
            $datescheckedtot = $datescheckedPM + $datescheckedAM;
            if ($datescheckedtot == 2){
                $dateAMPM++;
            }
        }
        $datedemi = $datetot - (2*$dateAMPM);
        //dd($dateAMPM);

        $billdemi = $datedemi * $tarifhalf;
        $billfull = $dateAMPM * $tariffull;
        $billtot = $billfull + $billdemi;
        //return view ('facturationpane', compact('datecount','month', 'year'));
        return view ('facture', compact('billtot', 'datedemi','month', 'year', 'billfull', 'tariffull', 'tarifhalf', 'dateAMPM', 'billdemi', 'fullname'));
        
    }
}
