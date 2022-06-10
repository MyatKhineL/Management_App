<?php

namespace App\Http\Controllers;

use App\Models\CheckinCheckout;
use App\Models\User;
use Illuminate\Http\Request;

class CheckinCheckoutController extends Controller
{
    public function checkInCheckOut(){
        return view('checkin_checkout');
    }
    public function checkIn(Request $request){
        return $request->pin_code;

        $user = User::where('pin_code', $request->pin_code)->first();
        if(!$user){
            return [
                'status'=>'fail',
                'message'=>'Pin code is wroung'
            ];
        }

        if(CheckinCheckout::whereNotNull('checkin_time')->exists()){
            return [
                 'status'=>'fail',
                 'message'=>'Already Checkin'
            ];
        }

        $checkin = new CheckinCheckout();
        $checkin->user_id = $user->id;
        $checkin->check_time  =  now();
        $checkin->save();
        return [
            'status'=>'fail',
            'message'=>'Successfully Check In at'.now(),
        ];





    }
}
