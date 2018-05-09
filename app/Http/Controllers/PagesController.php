<?php

namespace App\Http\Controllers;
use App\Country;

class PagesController extends Controller
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

    public function aboutus()
    {
        return view('pages.aboutus');
    }


    public function contactus()
    {
        return view('pages.contactus');
    }

    public function career()
    {
        return view('pages.career');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function help()
    {
        return view('pages.help');
    }


}
