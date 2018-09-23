<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class autonumber extends Model
{
   protected $table = 'autonumber';
    
    protected $fillable = array(
    	'year',
    	'month',
    	'number'
	);
}
