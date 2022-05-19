<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        $employee = auth()->user();
        return view('Profile.profile',compact('employee'));
    }
}
