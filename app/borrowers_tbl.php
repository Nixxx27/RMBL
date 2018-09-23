<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class borrowers_tbl extends Model
{
    protected $table = 'borrowers_tbl';
     protected $dates = ['open_date'];

    protected $fillable = array(
        'lname',
        'fname',
    	'mname',
    	'gender',
    	'age',
        'address',
    	'phone',
        'mobile',
    	'email',
    	'remarks',
    );

    public function theloans()
    {
        return $this->hasMany('App\loans_tbl','borrower_id');
    }


   
}
