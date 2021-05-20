<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Wink\WinkPost;

class BlogController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
	public function __construct()
	{
	    //$this->middleware('auth');
	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
	public function posts()
	{
		$posts = WinkPost::with('author')->where('published', '=', 1)->orderBy('publish_date', 'desc')->get();

		return view('frontend.page.posts', ['posts' => $posts]);
    	}

    	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
    	public function article( $slug )
    	{
    		$url = url()->current();
    		$post = WinkPost::with('author')->where('slug', '=', $slug )->first();

    		return view('frontend.page.article', ['post' => $post, 'url' => $url]);
    	}
}
