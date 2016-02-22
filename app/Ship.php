<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ship extends Model
{
    use SoftDeletes;

    protected $dates = ['date_submit'];


    public function phone()
    {

    	return $this->belongsTo(Phone::class);

    }

}
