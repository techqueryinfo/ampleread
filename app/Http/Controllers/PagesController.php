<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;
use App\Mail\ContactEmail;
use Mail;
use App\Plan;

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

    public function test()
    {
        return view('pages.test');
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

    /**
     * contact_us_mail
     * Used to send mail to the admin for contact us page
     * @param $name , $email , #msg
     *
     * @return mixed
     */
    public function contact_us_mail(Request $request)
    {
        $contact = [];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'msg' => 'required'
        ]);
        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['msg'] = $request->get('msg');
        // Mail delivery logic goes here
        Mail::to('vinod@mailinator.com')->send(new ContactEmail($contact));
        return redirect('contact-us')->with('success','Mail sent successfully');
    }

    /**
     * Subscription Page
     *
     * 
     */
    public function subscription()
    {   
        $all_plans = Plan::all();
        $data = ['all_plans'    => $all_plans];
        return view('pages.subscription')->with($data);
    }
}