<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class StaticController extends Controller
{
	/**
      * Create a new controller instance.
      *
      * @return void
      *
      */
    	public function __construct()
    	{
		
    	}


     /**
	 * Display the home page
	 *
	 * @return void
	 *
	 */
	public function index()
	{
		$listings = Listing::orderByDesc('modifydate')->limit(7)->get();

		return view('frontend.page.home', ['listings' => $listings]);
	}

	/**
	 * Display appraisal page
	 *
	 * @return void
	 *
	 */
	public function sell()
	{
		return view('frontend.page.sell');
	}

	/**
	 * Display the about us page
	 *
	 * @return void
	 *
	 */
	public function about()
	{
		return view('frontend.page.about');
	}

	/**
	 * Display the home page
	 *
	 * @return void
	 *
	 */
	public function contact()
	{
		return view('frontend.page.contact');
	}

	public function php()
    	{
    		phpinfo();
    	}
}
