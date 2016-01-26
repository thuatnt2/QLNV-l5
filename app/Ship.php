<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ship extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function phone()
    {

    	return $this->belongsTo(Phone::class);

    }

    public function shipNews()
    {

    	return $this->hasOne(ShipsNews::class);

    }

}
