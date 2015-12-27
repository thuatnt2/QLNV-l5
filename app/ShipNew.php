<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipNew extends Model
{

	use SoftDeletes;

	protected $dates = ['deleted_at'];


	public function ship()
	{

		return $this->hasOne(ShipNew::class);
		
	}
    
}
