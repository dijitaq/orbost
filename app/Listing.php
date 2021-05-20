<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Listing extends Model
{
	public $table = 'listings';

    	protected $jsonable = ['location', 'facilities', 'images', 'agents'];

    	/**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    	protected $fillable = [
     	'listing_id', 'classification', 'listingtype', 'status', 'price', 'location', 'facilities', 'heading', 'description', 'images', 'agents',
    	];
}
