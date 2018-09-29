<?php

namespace App\Http\Controllers;
use App\Category;
use App\Country;
use App\Book;
use App\HomeBook;
use App\Home;
use App\BookReview;
use App\Mail\StayInTouch;
use Mail;
use Illuminate\Http\Request;

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
        $categories = Category::all();
        $special_features = HomeBook::with('home_books')->where('type', 'special_feature')->get();
        $banner_images = Home::all();
        // $new_releases = HomeBook::with('home_books')->where('type', 'new_releases')->get();
        // $bestsellers  = HomeBook::with('home_books')->where('type', 'bestsellers')->get();
        // $classics     = HomeBook::with('home_books')->where('type', 'classics')->get();
        
        $home_books = array();
        foreach ($categories as $key => $value) {
            if($value->is_home_display == 1)
            {
                $home_books[$value->id]['category'] = $value;
                $home_books[$value->id]['books'] = HomeBook::with('home_books')->where('type', $value->id)->get();
            }
        }
        // echo "<pre>";
        // print_r($home_books);
        // exit;

        // foreach ($new_releases as $k => $v) 
        // {
        //     $book_review_star = BookReview::where('book_id', '=', $v->book_id)->sum('star');
        //     if(!empty($v->home_books))
        //         $v->home_books->star = $book_review_star/5;
        // }
        // foreach ($bestsellers as $k => $v) 
        // {
        //     $book_review_star = BookReview::where('book_id', '=', $v->book_id)->sum('star');
        //     if(!empty($v->home_books))
        //         $v->home_books->star = $book_review_star/5;
        // }
        // foreach ($classics as $k => $v) 
        // {
        //     $book_review_star = BookReview::where('book_id', '=', $v->book_id)->sum('star');
        //     if(!empty($v->home_books))
        //         $v->home_books->star = $book_review_star/5;
        // }
        return view('welcome', compact('countries', 'books', 'categories', 'special_features', 'home_books', 'banner_images'));
    }

    public function stayintouch(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData)){
            $mailData['email'] = $request->get('email');
            // Mail delivery logic goes here
            Mail::to('vinod@mailinator.com')->send(new StayInTouch($mailData));
            return view('stayintouch', compact('mailData'));
        }
        else
        {
            return redirect('welcome/');
        }

    }
    /*Temporary Controller till construction*/
    public function site()
    {
        return view('index');
    }
}
