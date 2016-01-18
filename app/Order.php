<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

	use SoftDeletes;

	/**
	 * [$dates The attributes that should be mutated to dates]
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function phones()
	{

		return $this->hasMany(Phone::class);
		
	}


    public function purposes()
    {

    	return $this->belongsToMany(Purpose::class);

    }

    public function kind()
    {

    	return $this->belongsTo(Kind::class);

    }

    public function unit() 
    {

    	return $this->belongsTo(Unit::class);

    }

    public function category() 
    {

    	return $this->belongsTo(Category::class);

    }

    public function user() 
    {

    	return $this->belongsTo(User::class);

    }

}
