<?php

namespace App\Http\Controllers;

use Auth;
use App\autonumber;
use Carbon\carbon;
use App\borrowers_tbl;
use App\borrowers_loans;
use App\User;
use App\interest;
use App\type;
use App\loan_account;
use App\loans_tbl;
use App\loan_account_transaction_details;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class LoanController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // if( Auth::user()->is_admin() )
        // {
        //     $borrower = borrowers_tbl::orderBy('id','DESC')->get();
        // }elseif( Auth::user()->is_collector() )
        // {

        //     $borrower = borrowers_tbl::orderBy('id','DESC')->get();
        // }

        if( Auth::user()->is_admin() )
        {
            $totalLoanAmount = DB::select('SELECT SUM(amount) AS ttl FROM loans_tbl ');
            $totalForCollection = DB::select('SELECT SUM(total_loan) AS ttl FROM loans_tbl ');
            $totalInterest = $totalForCollection[0]->ttl - $totalLoanAmount[0]->ttl;
            $loans = loans_tbl::paginate(10);
          
        }else
        {
            $authId = \Auth::user()->id;
            $totalLoanAmount = DB::select("SELECT SUM(amount) AS ttl FROM loans_tbl WHERE collector_id=$authId");
            $totalForCollection = DB::select("SELECT SUM(total_loan) AS ttl FROM loans_tbl WHERE collector_id=$authId");
            $totalInterest = $totalForCollection[0]->ttl - $totalLoanAmount[0]->ttl;

            $loans = loans_tbl::where("collector_id",Auth::user()->id)->paginate(10);
        }
        
        $loans->setPath('loans');
       
       
        
        return view('pages.loans.home',compact('loans','totalLoanAmount','totalForCollection','totalInterest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $interest = interest::first();
        $borrowers = borrowers_tbl::orderby('lname','asc')->get();

        return view('pages.loans.new',compact('borrowers','interest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request['is_new'] == 1) {
            $request['lname'] = $request['new_lname'];
            $request['fname'] = $request['new_fname'];

            $this->validate($request,
            [
                'lname'       => 'required|min:1',
                'fname'       => 'required|min:1',
            ],
                $messages = array('lname.required' => 'Last Name is required!',
                    'fname.required' => 'First Name is required!',
                 )
            );

            $borrowers_tbl = borrowers_tbl::create($request->all());
            $request['borrower_id'] = $borrowers_tbl->id;
        }else
        {
           
            $this->validate($request,
            [
                'borrower_id'       => 'required',
            ],
                $messages = array('borrower_id.required' => 'Borrower Name is required!',
                   
                 )
            );
        }

        #LOAN DETAILS VALIDATIONS
         $this->validate($request,
            [
                'start_date'       => 'required',
                'amount'       => 'required',
                'terms'       => 'required',
                'rate'       => 'required',
                'sched'       => 'required',
            ],
                $messages = array('start_date.required' => 'Start Date is required!',
                'amount.required' => 'Amount is required!',
                'terms.required' => 'Terms is required!',
                'rate.required' => 'Rate is required!',
                'sched.required' => 'Please select schedule!',  
                 )
            );
        
        ##CHECK IF HAS ASSIGNED ACCOUNT / MONEY OR IF HAS BALANCE.
        $has_assigned_account = loan_account::where("assigned_to",\Auth::user()->id)->first();

        if($has_assigned_account)
        {
            if($has_assigned_account->current_balance <= 0)
            {
                return \Redirect::back()->withErrors(["Loan Amount is greater than Funds! available  : " .$has_assigned_account->current_balance])->withInput(\Input::all());

            }else if($has_assigned_account->current_balance < $request['amount'])
            {
                // return back()->with([
                // 'has_an_error' => "Loan Amount is greater than Funds! available  : " .$has_assigned_account->current_balance
                // ]);

                 return \Redirect::back()->withErrors(["Loan Amount is greater than Funds! available  : " .$has_assigned_account->current_balance])->withInput(\Input::all());
            }
        }else
        {
            return back()->with([
                'has_an_error' => "You have no Funds!"
                ]);
        }


        ##GENERATE AUTONUMBER 
        #YEAR NOW##
        $year_now = date('y');

        #YEAR NOW##
        $month_now = date('m');


        $autonumber = autonumber::first();
        
         ##CHECK IF STORED AUTO NUMBER YEAR == YEAR NOW
        if($autonumber->year == $year_now && $autonumber->month == $month_now)
        {
            $autonumber = $autonumber;
        }else
        {
           #UPDATE YEAR AND RESET TO 0
            $autonumber->update([
                'year'      => $year_now,
                'month'     => $month_now,
                'number'    =>1]);

            $autonumber->save();

            $autonumber = $autonumber;
        }


        #IF NO PROBLEM PROCEED TO SAVE NEW LOAN
        $interest_divided_by_100 =  $request['rate'] / 100; // 5% / 100
        $monthly_interest = $interest_divided_by_100 * $request['amount'];
        $multiply_num_of_months =  $monthly_interest * $request['terms'];
        $total_amount = $request['amount'] + $multiply_num_of_months;


        $request['total_loan'] = $total_amount;
        $request['ref_num'] =  $autonumber->year . $autonumber->month .$autonumber->number;
        $request['collector_id'] = \Auth::user()->id;
        $request['status'] = "open";
        $request['balance'] = $request['total_loan'];

        #MATURIRY = START DATE * MATURITY
        $maturity = Carbon::createFromFormat('Y-m-d', $request["start_date"])->toDateString();
        $maturity = Carbon::parse($maturity);
        $request['maturity'] = $maturity->addMonths( $request["terms"]); 

        #SAVE
        $loan = loans_tbl::create($request->all());


        #ADD AUTONUMBER
            $autonumber->update([
                'year'      => $year_now,
                'month'     => $month_now,
                'number'    => $autonumber->number + 1]);
            $autonumber->save();
        
        #POPULATE TO BORROWERS LOAN TABLE

        

        if($request['sched']=='semimonthly')
        {
            $terms_count = $request['terms'] * 2 ;
        }else
        {
            $terms_count = $request['terms'];
        }
       // return $terms_count;

        $request['loan_id']= $loan->id;
        $request['due_amount'] = $total_amount /  $terms_count;
        $request['balance'] = $request['due_amount'] ;

        $due_date = Carbon::createFromFormat('Y-m-d', $request["start_date"])->toDateString();
        $due_date = Carbon::parse($due_date);
      

       for ($i=0; $i < $terms_count ; $i++) { 
            $request['due_date'] = $due_date->addMonths(1); 
            $borrowers_loans = borrowers_loans::create($request->all());
       }
        

        #CREATE LOAN ACCOUNT TRANSACTION HISTORY
         $request['loan_account_id'] = $has_assigned_account->id;
        #SINCE ITS A LOAN ITS DEDUCTED TO LOAN ACCOUNT
        $request['is_income'] = 0;
        $request['details'] = " Loan Amount by " . $loan->theborrower->lname . " ," . $loan->theborrower->fname;
        $request['transacted_by'] = \Auth::user()->id;
        $request['transaction_date'] =  $request["start_date"];
        $request['loan_id'] =  $loan->id;
        #SAVE TRANSACTION HISTORY
        $loan_account_transaction_details = loan_account_transaction_details::create($request->all());


        #UPDATE ACCOUNT REMAINING BALANCE
        $remaining_balance = $has_assigned_account->current_balance - $request['amount'];
        $has_assigned_account->update(['current_balance' => $remaining_balance]);


 // $borrowers_tbl = borrowers_tbl::updateOrCreate(
 //      ['id' => $request['borrower_id'] ],
 //      ['lname' =>  $request['lname'],
 //        'fname' =>  $request['fname'],
 //        'mname' =>  $request['mname'],
 //        'address' =>  $request['address'],
 //        'phone' =>  $request['phone'],
 //        'mobile' =>  $request['mobile'],
 //        'email' =>  $request['email'],

 //       ]
 //          );

        

        return back()->with([
            'loan_success' => "New Loan Successfully Created!",
            'loan_id' => $loan->id,
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

         $types = type::get();
        $loan = loans_tbl::findorfail($id);

        return view('pages.loans.show',compact('loan','types'));
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


    public function view_all_loans_of_borrower($id)
    {
         if( Auth::user()->is_admin() )
        {
            $totalLoanAmount = DB::select("SELECT SUM(amount) AS ttl FROM loans_tbl WHERE borrower_id=$id");
            $totalForCollection = DB::select("SELECT SUM(total_loan) AS ttl FROM loans_tbl  WHERE borrower_id=$id");
            $totalInterest = $totalForCollection[0]->ttl - $totalLoanAmount[0]->ttl;
            $loans = loans_tbl::where('borrower_id',$id)->paginate(10);
          
        }else
        {
            $authId = \Auth::user()->id;
            $totalLoanAmount = DB::select("SELECT SUM(amount) AS ttl FROM loans_tbl WHERE collector_id=$authId AND  borrower_id=$id");
            $totalForCollection = DB::select("SELECT SUM(total_loan) AS ttl FROM loans_tbl WHERE collector_id=$authId AND  borrower_id=$id");
            $totalInterest = $totalForCollection[0]->ttl - $totalLoanAmount[0]->ttl;

            $loans = loans_tbl::where("collector_id",Auth::user()->id)->where('borrower_id',$id)->paginate(10);
        }
        
        $loans->setPath('loans');
       
       
        
        return view('pages.loans.home',compact('loans','totalLoanAmount','totalForCollection','totalInterest'));
    }

    public function is_borrower_exist(Request $request) //not in use
    {
         $borrowers = borrowers_tbl::where("fname",$request['fname'])
        ->where("lname",$request['lname'])
        ->first();

        if($borrowers)
        {
            $count = $borrowers->count();
        }

       

        return json_encode(
            array(
                "count"     => $count,
                "address"    => $borrowers->address, 
               ));
    }

     public function search_borrowers(Request $request)
    {
         $borrowers = borrowers_tbl::where("fname",$request['fname'])
        ->where("lname",$request['lname'])
        ->first();

        return json_encode(
            array(
                "borrower_id"   =>$borrowers->id, 
                "fname"    => $borrowers->fname, 
                "address"    => $borrowers->address, 
                "gender"    => $borrowers->gender, 
                "age"    => $borrowers->age, 
                "phone"    => $borrowers->phone, 
                "mobile"    => $borrowers->mobile, 
                "email"    => $borrowers->email, 
               ));
    }

}
