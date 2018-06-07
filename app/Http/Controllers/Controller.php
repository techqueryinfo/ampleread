<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use App\Setting;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $site_settings = Session::get('site_settings');
        if(empty($site_settings)){
        	$site_settings = Setting::find(1);
        	if(empty($site_settings))
        	{
        		$site_settings = [
        			'site_logo' => 'logo-head.png',
        			'site_title' => 'AmpleRead e-Book',
        			'site_meta' => 'ample,ebook',
        			'admin_email' => 'vinod@mailinator.com',
        			'from_email' => 'vinod@mailinator.com'
        		];
        	}
        	session(['site_settings' =>$site_settings]);
        }
        $site_settings = Session::get('site_settings');

        $categories = Category::where('status', 'Active')->get();
        session(['categories' =>$categories]);
    }
}
