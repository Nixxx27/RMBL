<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class borrowers_loans extends Model
{
   	protected $table = 'borrowers_loans';
    protected $dates = ['open_date','due_date','date_of_payment'];

    protected $fillable = array(
        'loan_id',
        'collected_by',
    	'due_date',
    	'due_amount',
    	'date_of_payment',
        'paid_amount',
    	'balance',
        'payee_name',
    	'remarks',
    	'status',
    );

    public function theloan()
    {
        return $this->belongsTo('App\loans_tbl','loan_id');
    }


    public function thecollector()
    {
        return $this->belongsTo('App\User','collected_by');
    }


}
