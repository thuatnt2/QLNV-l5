<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
	// use SoftDeletes;
	/**
	 * [$dates The attributes that should be mutated to dates]
	 * @var array
	 */
    protected $dates = ['date_submit'];

    public function phone()
    {
    	return $this->belongsTo(Phone::class);
    }

    public function files()
    {
    	return $this->hasMany(File::class);
    }

    public function user()
    {
            return $this->belongsTo(User::class);
    }
}
