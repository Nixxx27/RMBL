<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan_account_transaction_details extends Model
{
    protected $table = 'loan_account_transaction_details';
    protected $dates = ['transaction_date','open_date'];

    // protected $guarded = [];
    protected $fillable = array(
        'transaction_date',
        'loan_account_id',
        'is_income',
    	'details',
    	'transacted_by',
        'loan_id',
    	'remarks',
        'amount',
    );

    public function theloanaccount()
    {
        return $this->belongsTo('App\loan_account','loan_account_id');
    }

    public function theloan()
    {
        return $this->belongsTo('App\loans_tbl','loan_id');
    }

    public function thecreator()
    {
        return $this->belongsTo('App\User','transacted_by');
    }
}
