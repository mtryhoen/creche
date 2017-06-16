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


class UsersController extends Controller
{
    //
    public function show(Request $request)
		{
			//$dateid = Request::get('dateid');
			$dateid = Request::all();
			$dateid = array_keys($dateid)[1];
			//dd($dateid);
			$dateid = explode('-', $dateid);
			$dateidtime=$dateid[0];
			$dateidid=$dateid[1];
			//if ($dateidtime == "am"){
				list ($dates, $usersam) = self::showam($dateidid);
				//dd($users);
			//}elseif ($dateidtime == "pm"){
				list ($dates, $userspm) = self::showpm($dateidid);
			//}  
			return view ('occuserslist', compact('usersam', 'userspm', 'dates'));
		}

    public function showam($dateid)
		{
	        $matchThese = ['calendar_id' => $dateid];
	        $usersid = calendar_users::where ($matchThese)->pluck('user_id');
	        $users=[];
	        foreach ($usersid as $userid){
	        	$matchThese1 = ['id' => $userid];
	        	$user = User::where ($matchThese1)->get();
		        $users[] = $user;
	        }
	       	$matchThese = ['id' => $dateid];
	       	$dates = Calendar::where ($matchThese)->get();
	       	//dd($date);
		    return array ($dates, $users);
		}

	public function showpm($dateid)
		{
			$matchThese = ['calendar_id' => $dateid];
	        $usersid = calendardemi_user::where ($matchThese)->pluck('user_id');
	        $users=[];
	        foreach ($usersid as $userid){
	        	$matchThese1 = ['id' => $userid];
	        	$user = User::where ($matchThese1)->get();
		        $users[] = $user;
	        }
	       	$matchThese = ['id' => $dateid];
	       	$dates = Calendar::where ($matchThese)->get();
	       	//dd($date);
		    return array ($dates, $users);
		}
}

