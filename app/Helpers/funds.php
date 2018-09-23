<?php


use App\User;
use App\type;
use App\loan_account;
use App\borrowers_loans;
use Carbon\carbon;
use Illuminate\Support\Facades\DB;
    
    function view_current_funds()
    {


    	if(\Auth::check())
    	{
    		$user_id= \Auth::user()->id;
			
            if( Auth::user()->is_admin() )
            {
              $totalFunds = DB::select('SELECT SUM(current_fund) AS ttl FROM loan_account ');
             return $totalFunds[0]->ttl;
            }else
            {
                $loan_account = loan_account::where('assigned_to',$user_id)->first();
                return ($loan_account)? $loan_account->current_balance : 0;
            }
           

			
    		
    	}else
    	{
    		return 0;
    	}
    }


    function overdue_loan_limit_5()
    {

       if(\Auth::check())
        {
            $date_now =  Carbon::now()->format('Y-m-d');       
            if( Auth::user()->is_admin() )
            {
             return  $loan_account = borrowers_loans::where('due_date','<', $date_now)->limit(5)->get();
            }else
            {
               return  $loan_account = borrowers_loans::whereHas('theloan', function ($query) {
                $query->where('collector_id', \Auth::user()->id);
                })
                ->where('due_date','<', $date_now)
                ->limit(5)
                ->get();
            }
           

            
            
        }else
        {
            return 0;
        }
         
    }
?>