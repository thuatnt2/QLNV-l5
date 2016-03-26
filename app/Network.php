<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{

    public function ships()
    {
    	return $this->belongsToMany(Ship::class);
    }
}
