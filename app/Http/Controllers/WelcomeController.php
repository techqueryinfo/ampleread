<?php

namespace App\Http\Controllers;
use App\Country;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
    	$countries = Country::all();
        return view('welcome', compact('countries'));
    }
}
