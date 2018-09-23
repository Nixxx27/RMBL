<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loans_tbl extends Model
{
    protected $table = 'loans_tbl';
    protected $dates = ['start_date','maturity'];

    protected $fillable = array(
        'ref_num',
        'borrower_id',
        'start_date',
        'maturity',
        'amount',
        'total_loan',
        'balance',
        'terms',
    	'rate',
    	'sched',
    	'collector_id',
        'remarks',
    	'status',
    );

    public function theborrower()
    {
        return $this->belongsTo('App\borrowers_tbl','borrower_id');
    }

    public function thecollector()
    {
        return $this->belongsTo('App\User','collector_id');
    }

    public function theborrowersloans()
    {
        return $this->hasMany('App\borrowers_loans','loan_id');
    }

}
