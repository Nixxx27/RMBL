<?php

namespace App\Http\Controllers;

use Carbon\carbon;
use App\User;
use App\type;
use App\loan_account;
use App\loan_account_transaction_details;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $collectors = User::orderBy('fullname','DESC')->get();
        $accounts = loan_account::orderBy('id','DESC')->get();
        return view('pages.accounts.home',compact('accounts','collectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = type::get();
        $collectors = User::orderBy('fullname','DESC')->get();
        return view('pages.accounts.new',compact('types','collectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,
            [
                'amount'       => 'required|min:1|numeric',
                'type_id'       => 'required|min:1',
                
                
            ],
                $messages = array('amount.required' => 'Amount is required!',
                    'type.required' => 'Cash type is required!',
                 )
            );

            $request['created_by'] = \Auth::user()->id;
            $request['current_fund'] =  $request['amount'];
            $request['current_balance'] =  $request['amount'];
            
            $loan_account = loan_account::create($request->all());
            
              

            return back()->with([
            'account_success' => "New Account Successfully Created!",
            'account_id' => $loan_account->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = loan_account::findorfail($id);
        $cashFlow  = loan_account_transaction_details::where('loan_account_id',$id)
        ->orderBy('transaction_date','ASC')->get();

        #PER COLLECTOR / PROJECTED INCOME
        if(  $account->assigned_to)
        {
        $totalAmount = DB::select("SELECT SUM(amount) AS ttl FROM loans_tbl WHERE collector_id=$account->assigned_to ");
        $totalLoan = DB::select("SELECT SUM(total_loan) AS ttl FROM loans_tbl WHERE collector_id=$account->assigned_to ");
        $projectedIncome = $totalLoan[0]->ttl - $totalAmount[0]->ttl;
        }else
        {
            $projectedIncome = 0;
        }
        return view('pages.accounts.cashflow',compact('account','cashFlow','projectedIncome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addfunds(Request $request, $id)
    {
        $this->validate($request,
            [
                'amount'       => 'required|min:1|numeric',
            ],
                $messages = array('amount.required' => 'Amount is required!',
          
                 )
            );

            #ADD LOAN TRANSACTION DETAILS
            $request['transaction_date']    = carbon::now()->format('Y-m-d');
            $request['loan_account_id']     = $id ;
            $request['is_income']     = 1 ;
            $request['transacted_by']     =   \Auth::user()->id;;
            $loan_transaction = loan_account_transaction_details::create($request->all());

            #ADD TO ACCOUNT CURRENT BALANCE
            $account = loan_account::findorfail($id);
            $account->update([
                'current_fund' => $account->current_fund + $request['amount'],
                'current_balance' => $account->current_balance + $request['amount'],
            ]);


            return back()->with([
             'flash_message' => "Successfully Added Funds!"
        ]);
    }

    public function assignedto(Request $request, $id)
    {

         $this->validate($request,
            [
                'assigned_to'       => 'required',
            ],
                $messages = array('assigned_to.required' => 'Please select Collector!',
          
                 )
            );

        $account = loan_account::findorfail($id);
        $account->update(['assigned_to'=>$request['assigned_to']]);
        
        return back()->with([
             'flash_message' => "Account Successfully Assigned to " . ucwords($account->assignedto->fullname) . " !"
        ]);
    }
}
