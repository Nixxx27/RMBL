<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan_account extends Model
{
    protected $table = 'loan_account';
     protected $dates = ['open_date'];

    protected $fillable = array(
        'acc_name',
        'current_fund',
        'current_balance',
    	'amount',
    	'type_id',
    	'open_date',
        'assigned_to',
    	'created_by',
        'description',
    	'remarks',
    );

    public function thetype()
    {
        return $this->belongsTo('App\type','type_id');
    }

      public function assignedto()
    {
        return $this->belongsTo('App\User','assigned_to');
    }

    public function thecreator()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
