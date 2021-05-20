<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Listing;

class ListingController extends Controller
{
	private $active_properties;
	private $active_length;
	private $active_counter = 0;

	private $inactive_properties;
	private $inactive_length;
	private $inactive_counter = 0;

	private $baseurl = 'https://integrations.mydesktop.com.au/api/v1.2';
	private $api_key = '2121705c7ee7aed1dee150c88f5fd63f8a22f4f0';
	private $access_token = 'eyJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiMjEyMTcwNWM3ZWU3YWVkMWRlZTE1MGM4OGY1ZmQ2M2Y4YTIyZjRmMCIsImFnZW50aWQiOjYwODU5MSwidHlwZSI6Im9mZmljZSIsImdyb3VwaWQiOjI2MzU0LCJwYXNzd29yZF9tb2RkYXRlIjoiMjAyMC0wNy0yNyAxMDowMzoyNyJ9.aZE_Y9YJ20kUeQUHsXyyUV08DHA43-mlSeo-65EA8ek';

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
	public function listings( $type ) {
		$title = "";
		$listingtype = "";

		if ($type == "buy") {
			$title = "SALE";
			$listingtype = "sale";

		} else if ($type == "rent") {
			$title = "RENT";
			$listingtype = "rent";
		}

		$listings = Listing::where('listingtype', '=', $listingtype)->orderByDesc('modifydate')->get();

		return view('frontend.page.listings', ['title' => $title, 'listings' => $listings]);
    }

    	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
	public function listing( $id, $slug ) {
		$listing = Listing::where('listing_id', '=', $id)->first();

		$location = json_decode($listing->location);
		$streetnum = $location[1]->streetnum;
		$street = ucwords(strtolower($location[0]->street));
		$suburb = ucwords(strtolower($location[2]->suburb));
		$state = ucwords(strtolower($location[3]->state));
		$title = $streetnum . ' ' . $street . ' '. $suburb . ', ' . $state;

		$facilities = json_decode($listing->facilities);

		$images = json_decode($listing->images);

		$agents = json_decode($listing->agents);


		return view('frontend.page.listing-detail', ['listing' => $listing, 'latitude' => $location[4]->latitude, 'longitude' => $location[5]->longitude, 'facilities' => $facilities, 'images' => $images, 'agents' => $agents, 'title' => $title]);
	}

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
    	public function update()
    	{
    		return view('frontend.page.update');	
    	}

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
    	public function update_complete()
    	{
    		return view('frontend.page.update-complete');	
    	}

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
	public function doupdate()
	{
		return redirect()->route('get-active');
	}

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
    public function getactive()
    {
    	$active_listings;
    	$inactive_listings;
		//$curl = curl_init();
    	
		$active_curl = curl_init($this->baseurl . '/properties?orderby=modifydate&agentid=608591&active=true&api_key=' . $this->api_key);
		$inactive_curl = curl_init($this->baseurl . '/properties?orderby=modifydate&agentid=608591&active=false&status=unconditional&api_key=' . $this->api_key);

		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
			curl_setopt($active_curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

    	curl_setopt($active_curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($active_curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($active_curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($active_curl, CURLOPT_USERPWD, $this->access_token . ":" . "");

		$active_httpCode = curl_getinfo($active_curl, CURLINFO_HTTP_CODE);

		if ( $active_httpCode == 504 ) {
			dd($active_httpCode);

		} else {
			$active_response = curl_exec($active_curl);

			curl_close($active_curl);

			$active_listings = json_decode($active_response);

			$this->active_length = $active_listings->totalRecords;

	    	$this->active_properties = $active_listings->properties;

	    	Listing::query()->truncate();

	    	foreach ($this->active_properties as $property) {
		    	$l = new Listing;
		    	$l->listing_id = $property->id;
		    	$l->slug = Str::slug($property->displayaddress, '-');
		    	$l->classification = $property->classification;
		    	$l->listingtype = $property->listingtype;
		    	$l->status = $property->status;
		    	$l->price = $property->pricefrom;

		    	//
		    	$location_arr = [];

		    	array_push($location_arr, ['street' => $property->address->street]);
		    	array_push($location_arr, ['streetnum' => $property->address->streetnum]);
		    	array_push($location_arr, ['suburb' => $property->address->suburb->name]);
		    	array_push($location_arr, ['state' => $property->address->suburb->state->abbreviation]);
		    	array_push($location_arr, ['latitude' => $property->address->suburb->latitude]);
		    	array_push($location_arr, ['longitude' => $property->address->suburb->longitude]);

		    	$l->location = json_encode($location_arr);

		    	//
		    	$facilities_arr = [];

		    	array_push($facilities_arr, ['bedrooms' => $property->bedrooms]);
		    	array_push($facilities_arr, ['bathrooms' => $property->toilets]);
		    	array_push($facilities_arr, ['cars' => $property->garages]);
		    	array_push($facilities_arr, ['area' => $property->buildingarea . " " . $property->buildingareatype]);

		    	$l->facilities = json_encode($facilities_arr);

		    	//
		    	$l->heading = $property->heading;

		    	$text_arr = explode("\n", $property->description);

		    	$body_text = "";

    		    foreach($text_arr as $text) {
    				$body_text .= '<p class="mb-1">' . $text . '</p>';
    			}

		    	$l->description = $body_text;

		    	// images
		    	$images_arr = [];

    		    foreach ($property->images as $image) {
    				array_push($images_arr, $image->url);
    			}

    			if (! empty($property->floorplans)) {
    				foreach ($property->floorplans as $image) {
    					array_push($images_arr, $image->url);
    				}
    			}

    			$l->images = json_encode($images_arr);

		    	// agents
		    	$agents_arr = [];
		    	array_push($agents_arr, ['name' => $property->agent->firstname . " " . $property->agent->lastname]);
		    	array_push($agents_arr, ['email' => $property->agent->email]);
		    	array_push($agents_arr, ['telephone' => $property->agent->mobiledisplay]);
		    	array_push($agents_arr, ['avatar' => $property->agent->imageurl]);

		    	$l->agents = json_encode($agents_arr);

		    	$l->modifydate = $property->modifydate;

		    	$l->save();
	    	}

	    	//get sold
			if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
				curl_setopt($inactive_curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			}

	    	curl_setopt($inactive_curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($inactive_curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($inactive_curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
			curl_setopt($inactive_curl, CURLOPT_USERPWD, $this->access_token . ":" . "");

			$inactive_httpCode = curl_getinfo($inactive_curl, CURLINFO_HTTP_CODE);

			if ($inactive_httpCode == 504) {
				dd($inactive_httpCode);

			} else {
				$inactive_response = curl_exec($inactive_curl);

				curl_close($inactive_curl);

				$inactive_listings = json_decode($inactive_response);

				$this->inactive_length = $inactive_listings->totalRecords;

			    $this->inactive_properties = $inactive_listings->properties;

			    foreach ($this->inactive_properties as $property) {
			    	$l = new Listing;
			    	$l->listing_id = $property->id;
			    	$l->slug = Str::slug($property->displayaddress, '-');
			    	$l->classification = $property->classification;
			    	$l->listingtype = $property->listingtype;
			    	$l->status = $property->status;
			    	$l->price = $property->pricefrom;

			    	//
			    	$location_arr = [];

			    	array_push($location_arr, ['street' => $property->address->street]);
			    	array_push($location_arr, ['streetnum' => $property->address->streetnum]);
			    	array_push($location_arr, ['suburb' => $property->address->suburb->name]);
			    	array_push($location_arr, ['state' => $property->address->suburb->state->abbreviation]);
			    	array_push($location_arr, ['latitude' => $property->address->suburb->latitude]);
			    	array_push($location_arr, ['longitude' => $property->address->suburb->longitude]);

			    	$l->location = json_encode($location_arr);

			    	//
			    	$facilities_arr = [];

			    	array_push($facilities_arr, ['bedrooms' => $property->bedrooms]);
			    	array_push($facilities_arr, ['bathrooms' => $property->toilets]);
			    	array_push($facilities_arr, ['cars' => $property->garages]);
			    	array_push($facilities_arr, ['area' => $property->buildingarea . " " . $property->buildingareatype]);

			    	$l->facilities = json_encode($facilities_arr);

			    	//
			    	$l->heading = $property->heading;

			    	$text_arr = explode("\n", $property->description);

			    	$body_text = "";

		    		foreach($text_arr as $text)
	    			{
	    				$body_text .= '<p class="mb-1">' . $text . '</p>';
	    			}

			    	$l->description = $body_text;

			    	// images
			    	$images_arr = [];

			    	foreach ($property->images as $image) {
						array_push($images_arr, $image->url);
		    		}

	    			if (! empty($property->floorplans)) {
	    				foreach ($property->floorplans as $image) {
	    					array_push($images_arr, $image->url);
	    				}
	    			}

		    		$l->images = json_encode($images_arr);

			    	// agents
			    	$agents_arr = [];
			    	array_push($agents_arr, ['name' => $property->agent->firstname . " " . $property->agent->lastname]);
			    	array_push($agents_arr, ['email' => $property->agent->email]);
			    	array_push($agents_arr, ['telephone' => $property->agent->mobiledisplay]);
			    	array_push($agents_arr, ['avatar' => $property->agent->imageurl]);

			    	$l->agents = json_encode($agents_arr);

			    	$l->modifydate = $property->modifydate;

			    	$l->save();
			    }

			    return redirect()->route('update-complete');
			}
		}
    }

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	 */
    public function getsold()
    {
		$baseurl = 'https://integrations.mydesktop.com.au/api/v1.2';
    	$api_key = '2121705c7ee7aed1dee150c88f5fd63f8a22f4f0';
    	$access_token = 'eyJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiMjEyMTcwNWM3ZWU3YWVkMWRlZTE1MGM4OGY1ZmQ2M2Y4YTIyZjRmMCIsImFnZW50aWQiOjYwODU5MSwidHlwZSI6Im9mZmljZSIsImdyb3VwaWQiOjI2MzU0LCJwYXNzd29yZF9tb2RkYXRlIjoiMjAyMC0wNy0yNyAxMDowMzoyNyJ9.aZE_Y9YJ20kUeQUHsXyyUV08DHA43-mlSeo-65EA8ek';
	    
		//$curl = curl_init();
    	
		$ch = curl_init($baseurl . '/properties?orderby=modifydate&agentid=608591&active=false&status=unconditional&api_key=' . $api_key);

		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_USERPWD, $access_token . ":" . "");
		
		$listings;
		
		//$response = curl_exec($ch);
		//$err = curl_error($ch);
		//curl_close($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ( $httpCode == 504) {
			dd($httpCode);

		} else {
			$response = curl_exec($ch);

			curl_close($ch);

			$listings = json_decode($response);

			$this->length = $listings->totalRecords;

		    $this->properties = $listings->properties;

		    foreach ($this->properties as $property) {
		    	$l = new Listing;
		    	$l->listing_id = $property->id;
		    	$l->slug = Str::slug($property->displayaddress, '-');
		    	$l->classification = $property->classification;
		    	$l->listingtype = $property->listingtype;
		    	$l->status = $property->status;
		    	$l->price = $property->pricefrom;

		    	//
		    	$location_arr = [];

		    	array_push($location_arr, ['street' => $property->address->street]);
		    	array_push($location_arr, ['streetnum' => $property->address->streetnum]);
		    	array_push($location_arr, ['suburb' => $property->address->suburb->name]);
		    	array_push($location_arr, ['state' => $property->address->suburb->state->abbreviation]);
		    	array_push($location_arr, ['latitude' => $property->address->suburb->latitude]);
		    	array_push($location_arr, ['longitude' => $property->address->suburb->longitude]);

		    	$l->location = json_encode($location_arr);

		    	//
		    	$facilities_arr = [];

		    	array_push($facilities_arr, ['bedrooms' => $property->bedrooms]);
		    	array_push($facilities_arr, ['bathrooms' => $property->toilets]);
		    	array_push($facilities_arr, ['cars' => $property->garages]);
		    	array_push($facilities_arr, ['area' => $property->buildingarea . " " . $property->buildingareatype]);

		    	$l->facilities = json_encode($facilities_arr);

		    	//
		    	$l->heading = $property->heading;

		    	$text_arr = explode("\n", $property->description);

		    	$body_text = "";

	    		foreach($text_arr as $text)
    			{
    				$body_text .= '<p class="mb-1">' . $text . '</p>';
    			}

		    	$l->description = $body_text;

		    	// images
		    	$images_arr = [];

		    	foreach ($property->images as $image) {
					array_push($images_arr, $image->url);
	    		}

    			if (! empty($property->floorplans)) {
    				foreach ($property->floorplans as $image) {
    					array_push($images_arr, $image->url);
    				}
    			}

	    		$l->images = json_encode($images_arr);

		    	// agents
		    	$agents_arr = [];
		    	array_push($agents_arr, ['name' => $property->agent->firstname . " " . $property->agent->lastname]);
		    	array_push($agents_arr, ['email' => $property->agent->email]);
		    	array_push($agents_arr, ['telephone' => $property->agent->mobiledisplay]);
		    	array_push($agents_arr, ['avatar' => $property->agent->imageurl]);

		    	$l->agents = json_encode($agents_arr);

		    	$l->modifydate = $property->modifydate;

		    	$l->save();
		    }

		   	return redirect()->route('update-complete');
		}
    }


    private function single()
    {
    		$baseurl = 'https://integrations.mydesktop.com.au/api/v1.2';
	    	$api_key = '2121705c7ee7aed1dee150c88f5fd63f8a22f4f0';
	    	$access_token = 'eyJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiMjEyMTcwNWM3ZWU3YWVkMWRlZTE1MGM4OGY1ZmQ2M2Y4YTIyZjRmMCIsImFnZW50aWQiOjYwODU5MSwidHlwZSI6Im9mZmljZSIsImdyb3VwaWQiOjI2MzU0LCJwYXNzd29yZF9tb2RkYXRlIjoiMjAyMC0wNy0yNyAxMDowMzoyNyJ9.aZE_Y9YJ20kUeQUHsXyyUV08DHA43-mlSeo-65EA8ek';
	    
		//$curl = curl_init();
    	
    		$ch = curl_init($baseurl . '/properties/' . $this->properties[$this->counter]->id . '?&api_key=' . $api_key);
		
		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_USERPWD, $access_token . ":" . "");
		
		$decoded;
		
		$response = curl_exec($ch);
		$err = curl_error($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ( $httpCode == 504) {
			dd($httpCode);
		    
		} else {
			$response = curl_exec($ch);

			curl_close($ch);

		    	$listing = json_decode($response);

		    	$l = new Listing;
		    	$l->listing_id = $listing->property->id;
		    	$l->slug = Str::slug($listing->property->displayaddress, '-');
		    	$l->classification = $listing->property->classification;
		    	$l->listingtype = $listing->property->listingtype;
		    	$l->status = $listing->property->status;
		    	$l->price = $listing->property->pricefrom;

		    	//
		    	$location_arr = [];

		    	array_push($location_arr, ['street' => $listing->property->address->street]);
		    	array_push($location_arr, ['streetnum' => $listing->property->address->streetnum]);
		    	array_push($location_arr, ['suburb' => $listing->property->address->suburb->name]);
		    	array_push($location_arr, ['state' => $listing->property->address->suburb->state->abbreviation]);
		    	array_push($location_arr, ['latitude' => $listing->property->address->suburb->latitude]);
		    	array_push($location_arr, ['longitude' => $listing->property->address->suburb->longitude]);

		    	$l->location = json_encode($location_arr);

		    	//
		    	$facilities_arr = [];

		    	array_push($facilities_arr, ['bedrooms' => $listing->property->bedrooms]);
		    	array_push($facilities_arr, ['bathrooms' => $listing->property->toilets]);
		    	array_push($facilities_arr, ['cars' => $listing->property->garages]);
		    	array_push($facilities_arr, ['area' => $listing->property->buildingarea . " " . $listing->property->buildingareatype]);

		    	$l->facilities = json_encode($facilities_arr);

		    	//
		    	$l->heading = $listing->property->heading;

		    	$text_arr = explode("\n", $listing->property->description);

		    	$body_text = "";

		    	foreach($text_arr as $text)
			{
				$body_text .= '<p class="mb-1">' . $text . '</p>';
			}

		    	$l->description = $body_text;

		    	// images
		    	$images_arr = [];

		    	foreach ($listing->property->images as $image) {
				array_push($images_arr, $image->url);
			}

			if (! empty($listing->property->floorplans)) {
				foreach ($listing->property->floorplans as $image) {
					array_push($images_arr, $image->url);
				}
			}

			$l->images = json_encode($images_arr);

		    	// agents
		    	$agents_arr = [];
		    	array_push($agents_arr, ['name' => $listing->property->agent->firstname . " " . $listing->property->agent->lastname]);
		    	array_push($agents_arr, ['email' => $listing->property->agent->email]);
		    	array_push($agents_arr, ['telephone' => $listing->property->agent->mobiledisplay]);
		    	array_push($agents_arr, ['avatar' => $listing->property->agent->imageurl]);

		    	$l->agents = json_encode($agents_arr);

		    	$l->modifydate = $listing->property->modifydate;

		    	$l->save();

		    	if ($this->counter < ($this->length - 1)) {
		    		$this->counter++;

		    		$this->single();

		    	}
		}

		return redirect()->route('update-complete');
    }


    public function view( $id )
    {
    		$baseurl = 'https://integrations.mydesktop.com.au/api/v1.2';
	    	$api_key = '2121705c7ee7aed1dee150c88f5fd63f8a22f4f0';
	    	$access_token = 'eyJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiMjEyMTcwNWM3ZWU3YWVkMWRlZTE1MGM4OGY1ZmQ2M2Y4YTIyZjRmMCIsImFnZW50aWQiOjYwODU5MSwidHlwZSI6Im9mZmljZSIsImdyb3VwaWQiOjI2MzU0LCJwYXNzd29yZF9tb2RkYXRlIjoiMjAyMC0wNy0yNyAxMDowMzoyNyJ9.aZE_Y9YJ20kUeQUHsXyyUV08DHA43-mlSeo-65EA8ek';
	    
		//$curl = curl_init();
    	
    		$ch = curl_init($baseurl . '/properties/' . $id . '?&api_key=' . $api_key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_USERPWD, $access_token . ":" . "");
		
		$decoded;
		
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		
		if ($err) {
		    echo "cURL Error #:" . $err;
		    
		} else {
		    $decoded = json_decode($response);
		    dd($decoded, true);
		}
    }
}
