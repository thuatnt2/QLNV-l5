<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purpose extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_ad'];

	/**
	 * [orders description]
	 * @return [type] [description]
	 */
    public function orders()
    {

    	return $this->belongsToMany(Order::class);
    	
    }
}
