<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{

	use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function orders() 
    {

    	return $this->hasMany(Order::class);

    }
}
