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
  //       echo "<pre>";
  //       // print_r($countries);
  //       foreach ($countries as $country) {
		//     echo $country->countryname;
		// }
		// exit;
        return view('welcome', compact('countries'));
    }
}
