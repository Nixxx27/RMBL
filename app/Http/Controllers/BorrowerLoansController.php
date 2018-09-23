<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\borrowers_loans;
use Carbon\carbon;
use App\loan_account;
use App\loan_account_transaction_details;

class BorrowerLoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function borrowers_loans_payments(Request $request, $id)
    {
         $this->validate($request,
            [
                'date_of_payment'        => 'required',
                'payee_name'        => 'required',
                'paid_amount'       => 'required',
                'mode_of_payment'       => 'required',
            ],
                $messages = array('payee_name.required' => 'Payee Name is required!',
            'paid_amount.required' => 'Payment Amount is required!',
            'date_of_payment.required' => 'Date of payment is required!',
            'mode_of_payment'   => 'Mode of Payment is Required!')
            );

        $borrowers_loans = borrowers_loans::findorfail($id);



        $request['collected_by'] = \Auth::user()->id;
        $request['balance'] = $borrowers_loans->due_amount - $request['paid_amount'];
        if($borrowers_loans->due_amount >  $request['paid_amount'])
        {
            $request['status'] = 'withbalance';
        }else
        {
            $request['status'] = 'paid';
        }
        
        #UPDATE BORROWERS LOAN DETAILS
        $borrowers_loans->update($request->all());
        $findLoanAccount = loan_account::where('assigned_to',$borrowers_loans->theloan->thecollector->id)->first();

            #ADD TO ACCOUNT

            $request['transaction_date']    = $request['date_of_payment'];
            $request['loan_account_id']     =  $findLoanAccount->id ;
            $request['is_income']     = 1 ;
            $request['transacted_by']     =   \Auth::user()->id;
            $request['details'] = "Loan Payment by " . $request['payee_name'];
            $request['amount']     = $request['paid_amount'] ;
            $request['loan_id'] = $borrowers_loans->theloan->id ;
            $loan_transaction = loan_account_transaction_details::create($request->all());

            #ADD TO ACCOUNT CURRENT BALANCE
            $account = loan_account::findorfail($findLoanAccount->id);
            $account->update([
                'current_fund' => $account->current_fund + $request['paid_amount'],
                'current_balance' => $account->current_balance + $request['paid_amount'],
            ]);

         return back()->with([
             'flash_message' => "Payment Successfull!"
        ]);

         
    }
}
