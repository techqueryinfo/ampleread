<?php

namespace App\Http\Controllers;
use App\Country;
use App\Book;

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
        $books = Book::all();
        return view('welcome', compact('countries','books'));
    }
}
