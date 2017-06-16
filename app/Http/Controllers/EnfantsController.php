<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\User;

class EnfantsController extends Controller
{
    //
    public function show()
    {
    	$users = User::all();
    	//dd($users);
        return view('formenfants', compact ('users'));
    }

    public function save(Request $request)
    {
        $data = Request::all();
        $data = array_keys($data);
        //dd(count($data));
        if(count($data) > 3) {
            $this->supprimer($data[3]);
        }else{
            $userstariffull = Request::get('tariffull');
            $userstarifhalf = Request::get('tarifhalf');
            //dd($userstariffull);
            
            foreach ($userstariffull as $userid => $usertariffull){
            	$user = User::find($userid);
            	$user->tariffull = $usertariffull;
            	$user->save();
        	}
        	foreach ($userstarifhalf as $userid => $usertarifhalf){
            	$user = User::find($userid);
            	$user->tarifhalf = $usertarifhalf;
            	$user->save();
        	}
    		
    		$users = User::all();

    		return view('formenfants', compact ('users'));
        }
        $users = User::all();
        return view('formenfants', compact ('users'));
    }

    public function supprimer($userid)
    {
        //dd($userid);
        $user = User::find($userid);
        $user->delete();
    }
}
