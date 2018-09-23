@extends('layouts.app_template')
@section('css')
<style type="text/css">
    th{
        font-weight: bold !important;
        font-weight:15px !important;
        font-family: calibri !important;
        text-align:center;
    }
    .th-bg
    {
        background:#027647;
        color:white;

    }

    td {
        font-size:14px !important;
     
    }
    .td-center
    {
        border:1px solid #d6d6d6;
        text-align:center;
    }
</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <a href="{{url('loans')}}"><button class="btn btn-info btn-sm" style="margin-bottom:5px"><i class="fas fa-chevron-left"></i> Back</button>
                </a>
             <h3 class="text-themecolor" style="color:#1BA196"><strong>VIEW LOAN DETAILS</strong></h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('loans')}}">Loans</a></li>
                <li class="breadcrumb-item active">Loan Details</li>
            </ol>
        </div>

      
   {{--  <div>
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div> --}}
</div>
 <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<hr>
<div class="row" style="padding-bottom:5px">
    <div class="col-md-12">
            @include('errors.with_error')
            @include('errors.success')
    </div>

    <div class="col-md-1"></div>
   <div class="col-md-1"><img src="http://localhost/rmbl/public/images/users/1.jpg" alt="user" class="img-responsive" > </div>
     <div class="col-md-4">
        <h4><strong>{{strtoupper($loan->theborrower->lname)}}, {{strtoupper($loan->theborrower->fname)}}, {{strtoupper($loan->theborrower->mname)}}<br>
        <small>{{strtoupper($loan->theborrower->gender)}}, {{$loan->theborrower->age}}</small></strong> </h4>
        <a href="{{url('loans/by')}}/{{$loan->theborrower->id}}">
        <button type="button" class="btn btn-success btn-sm" title="View All Loan of {{strtoupper($loan->theborrower->lname)}}, {{strtoupper($loan->theborrower->fname)}}, {{strtoupper($loan->theborrower->mname)}}">View All Loans</button>
        </a>
    </div>
   

    <div class="col-md-4">
        <table cellspacing="2" cellpadding="2" >
            <tr>
                <td><span style="font-weight: bold">Address : </span></td>
                <td> {{($loan->theborrower->address)}}</td>
            </tr>

            <tr>
                <td><span style="font-weight: bold">Landline : </span></td>
                <td> {{($loan->theborrower->phone)}}</td>
            </tr>

            <tr>
                <td><span style="font-weight: bold">Mobile : </span></td>
                <td> {{($loan->theborrower->mobile)}}</td>
            </tr>

            <tr>
                <td><span style="font-weight: bold">Email Add : </span></td>
                <td> {{($loan->theborrower->email)}}</td>
            </tr>
            <tr>
                <td><span style="font-weight: bold">Created By : </span></td>
                <td>{{ucwords($loan->thecollector->fullname)}}</td>
            </tr>
        </table>
       
    </div>
</div><!--row-->
<hr>
<div class="row" style="margin-top:30px;border-top: 4px outset #FFB22B;">
 
    <div class="col-md-12">
        <table class="table table-responsive" style="margin-top:10px">
            <tr>
                <th>RELEASE DATE</th>
                <th>MATURITY</th>
                <th>PRINCIPAL AMOUNT</th>
                <th>TERMS</th>
                <th>INTEREST RATE</th>
                <th>TOTAL LOAN</th>
                <th>MONTHLY AMORTIZATION</th>
                <th>TOTAL INTEREST</th>
                <th>TOTAL PAYMENT</th>
                <th>STATUS</th>
                
            </tr>
            <tr>
                <td class="td-center">{{$loan->start_date->format('M d Y D')}} </td>
                <td class="td-center">{{$loan->maturity->format('M d Y D')}} </td>
                <td class="td-center">&#8369; {{number_format($loan->amount,2)}}</td>
                <td class="td-center">{{$loan->terms}} @if($loan->terms==1) mo. @else mos. @endif</td>
                <td class="td-center">{{$loan->rate}}% per @if($loan->sched=='monthly')mo. @else Semi-Monthly @endif</td>
                <td class="td-center" style="font-weight:bold">&#8369; {{number_format($loan->total_loan,2)}}</td>
                <td class="td-center">&#8369; {{ $loan->total_loan / $loan->terms }}</td>
                <td class="td-center">&#8369; {{ $loan->total_loan - $loan->amount}}</td>
                <td class="td-center" style="font-weight:bold">&#8369; {{ $loan->total_loan }}</td>
                <td class="td-center" style="@if($loan->status=='open') background:#f4e521;color:white @endif;font-weight: bold;color:#353535">{{ strtoupper($loan->status)}}</td>

            </tr>
           
         </table>
        @if($loan->remarks)
            <div class="col-md-1"></div>
            <div class="col-sm-1 col-md-1">
                <span style="font-weight: bold;font-size: 14px">REMARKS</span>
            </div>

            <div class="col-sm-12 col-md-12">
                <textarea class="form-control" style="background:none" readonly=""> {{ $loan->remarks}}</textarea>
               
            </div>
        @endif
        
    </div>
</div><!--row-->
<hr>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-warning btn-sm" style="margin-bottom:10px">Add Payment</button>
<div class="table-responsive">
        <table class="table">
            <tr>
                <th class="th-bg">AMOUNT TO PAY</th>
                <th class="th-bg">DUE DATE</th>
                <th class="th-bg">COLLECTED BY</th>

                <th class="th-bg">PAID AMOUNT</th>
                <th class="th-bg">DATE OF PAYMENT</th>
                <th class="th-bg">BALANCE</th>
                <th class="th-bg">STATUS</th>
                <th class="th-bg"></th>
            </tr>
            @foreach($loan->theborrowersloans as $loan_details)
            <tr>
                <td>@if($loan_details->due_amount)&#8369; {{number_format($loan_details->due_amount,2)}}@endif</td>
                <td>{{$loan_details->due_date->format('M d Y D')}} 
                    @if($loan_details->due_date < date('Y-m-d') AND $loan_details->status=='unpaid' OR $loan_details->due_date < date('Y-m-d') AND $loan_details->status=='open')
                    <span style="color:red;font-size:11px;font-weight: bold"><img src="{{url('public/images/overdue.png')}}" title="This Loan is Overdue" style="width: 20px"> overdue </span>
                    @endif

                </td>
                <td>@if($loan_details->thecollector){{ucwords($loan_details->thecollector->fullname)}}@else - @endif</td>
                <td>@if($loan_details->paid_amount)&#8369; {{number_format($loan_details->paid_amount,2)}}@else - @endif</td>
                <td>@if($loan_details->date_of_payment){{$loan_details->date_of_payment->format('M d Y D')}}@else - @endif</td>
                <td>@if($loan_details->balance)&#8369; {{number_format($loan_details->balance,2)}}@else - @endif</td>
                <td>
                    @if($loan_details->status=='paid')
                    <span style="color:#00a65a;font-weight: bold"><i class="fas fa-check"></i>
                    @else
                      <span style="font-weight: bold">
                    @endif
                     {{strtoupper($loan_details->status)}}</span>
                   
                </td>
                <td style="text-align:center">
             @if($loan_details->status=='open' OR $loan_details->status=='unpaid' )
                <button type="button" title="Pay Amortization" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$loan_details->id}}"><i class="fab fa-amazon-pay fa-2x "></i></button>
        
               <!-- Modal -->

<div id="myModal{{$loan_details->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background:#027647;">
        <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
        <h4 class="modal-title" style="color:white !important">Payment for {{$loan_details->due_date->format('M d Y D')}}</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'borrowers_loans/payments/' . $loan_details->id,'method' => 'POST')) }}
        <table>
            <tr>
                <td><label style="font-weight: bold">DATE OF PAYMENT</label></td>
                <td><input type="date" name="date_of_payment" id="date_of_payment" class="form-control" value="@if(old('date_of_payment')){{old('date_of_payment')}}@else{{date('Y-m-d')}}@endif"></td>
            </tr>
            <tr>
                <td><label style="font-weight: bold">AMOUNT PAID <i class="fas fa-money-bill-alt"></i></label></td>
                <td><input type="text" name="paid_amount" class="form-control" value="@if(old('paid_amount')){{old('paid_amount')}}@else{{$loan_details->due_amount}}@endif"></td>
            </tr>

            <tr>
                <td><label style="font-weight: bold">PAYEE </label></td>
                <td><input type="text" name="payee_name" class="form-control" value="@if(old('payee_name')){{old('payee_name')}}@else{{ucwords($loan->theborrower->fname)}} {{ucwords($loan->theborrower->lname)}}@endif"></td>
            </tr>

            <tr>
                <td><label style="font-weight: bold">MODE OF PAYMENT </label></td>
                <td>
                    <select class="form-control custom-select" id="mode_of_payment" name="mode_of_payment">
                        
                            @foreach($types as $type)
                            <option value="{{$type->name}}">{{ucwords($type->name)}}</option>
                            @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label style="font-weight: bold">REMARKS</label></td>
                <td><textarea class="form-control" name="remarks">{{old('remarks')}}</textarea></td>
            </tr>
        </table>
   
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to Proceed?')"><i class="fa fa-check"></i> CONFIRM PAYMENT</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
    @endif
                </td> 
            </tr>
            @endforeach
        </table>
    </div>
    </div>
</div><!--row-->

@endsection

