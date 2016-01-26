<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipsNews extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];


	public function ship()
	{

		return $this->hasOne(ShipNew::class);
		
	}
}
