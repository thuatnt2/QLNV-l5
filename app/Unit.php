<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SofDeletes;

class Unit extends Model
{

	use SofDeletes;
    
    protected $dates = ['deleted_at'];

    public function orders() 
    {

    	return $this->hasMany(Order::class);

    }
}
