<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    public function ship()
    {

    	return $this->belongsTo(Ship::class);

    }

}
