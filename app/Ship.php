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

    public function file()
    {
        return $this->hasOne(File::class);
    }

    public function user()
    {
            return $this->belongsTo(User::class);
    }

    public function networks()
    {
        $this->belongsToMany(Network::class);
    }

}
