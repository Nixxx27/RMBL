@extends('layouts.app_template')

@section('css')
<style type="text/css">
    th{
       font-weight: bold !important;
        font-size: 14px !important;
       /*text-transform: uppercase;*/
    }
    table{
        font-size: 12px;
    }

    .red{
        color: #ef5350;
        font-size:12px;
        font-weight: 600;
    }

    .green{
        color: #06d79c;
        font-size:12px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
             <h3 class="text-themecolor" style="color:#1BA196"><strong>{{strtoupper($account->acc_name)}} CASH FLOW @if($account->assigned_to) <small> - ({{strtoupper($account->assignedto->fullname)}}) </small> @endif</strong></h3>
        </div>

        <div class="col-md-6 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('accounts')}}">Account Lists</a></li>
                <li class="breadcrumb-item active">Cash Flow of {{strtolower($account->acc_name)}}</li>
            </ol>
        </div>
    
     <div class="col-md-5" style="margin-top:10px">
        <a href="{{url('accounts')}}"><button class="btn btn-info btn-sm" style="margin-bottom:5px"><i class="fas fa-chevron-left"></i> Back</button>
                </a>
    </div>

     <div class="col-md-7" style="margin-top:10px;font-weight: bold;font-size:14px">
        <span style="color:#06d79c"><span title="Starting Amount">TOTAL FUND :</span> @if(!empty($account->current_fund))&#8369; {{number_format($account->current_fund,2)}}@endif </span> |
        <?php $cbFontColor = ( $account->current_fund > $account->current_balance )? '#ef5350'  : '#06d79c'; ?>
        <span style="color:{{$cbFontColor}}">

        <span title="Current Balance">CURRENT BALANCE :</span> @if(!empty($account->current_balance))&#8369; {{number_format($account->current_balance,2)}}@endif
       </span>
        @include('pages.accounts.showpercentage')

        @if($account->assigned_to)
       <br>
       <?php $loandAmount =$account->current_fund -$account->current_balance; ?>
       <span title="Current Balance">LOANED AMOUNT:</span> @if(!empty($loandAmount))&#8369; {{number_format($loandAmount,2)}}@endif | <span title="Current Balance" style="color:#00a65a">INCOME:@if(!empty($projectedIncome))&#8369; {{number_format($projectedIncome,2)}}</span> @endif
       </span>
       @endif
       


        <br><span style="float: right;"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addFundModal"><i class="fas fa-plus "></i><span style=";font-weight: bold"> ADD FUND</span> </button>
                </span>
    </div>
</div>
 <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<hr>
<div class="row">
      <div class="col-md-12">
            @include('errors.with_error')
            @include('errors.success')
        </div>

    <div class="col-md-12">
        <table class="table color-bordered-table info-bordered-table">
                <thead>
                    <tr>
                       <th>DATE</th>
                        <th>AMOUNT</th>
                        <th>DETAILS</th>
                        <th>TRANSACTION BY</th>
                        <th>REMARKS</th>
                    </tr>
               </thead>
                <tbody>
                    <tr>
                        <td>@if($account->open_date){{$account->open_date->format('M d Y D')}}@endif</td>
                        <td><span class="green" >@if(!empty($account->amount))&#8369; {{number_format($account->amount,2)}}@endif </span></td>
                        <td>Starting Amount</td>
                        <td>@if($account->thecreator){{ucwords($account->thecreator->fullname)}}@else - @endif</td>
                        <td>S{{$account->remarks}}</td>
                    </tr>
                    @foreach($cashFlow as $flow)
                    <tr>
                        <td>@if($flow->transaction_date){{$flow->transaction_date->format('M d Y D')}}@endif</td>
                        <td>
                            <a @if($flow->theloan)href="{{url('loans')}}/{{$flow->theloan->id}}" target="_blank" @else href="#" @endif>
                            <span class="{{ ($flow->is_income==1)? 'green' : 'red' }}" >@if(!empty($flow->amount))&#8369; {{number_format($flow->amount,2)}}@endif </span>
                            </a>
                        </td>
                        <td>{{$flow->details}}</td>

                        <td>@if($flow->thecreator){{ucwords($flow->thecreator->fullname)}}@else - @endif</td>
                        <td>{{$flow->remarks}}</td>
                    </tr>

                    @endforeach
                </tbody>
        </table>        
    </div><!--div 11-->
</div>
@endsection



@section('modal')

<div id="addFundModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background:#027647;">
        <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
        <h4 class="modal-title" style="color:white !important">ADD FUND : {{strtoupper($account->acc_name)}}</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'accounts/addfunds/' . $account->id,'method' => 'POST')) }}
        <table class="table">
            
            <tr>
                <td><label style="font-weight: bold">AMOUNT <i class="fas fa-money-bill-alt"></i></label> <span style="color:red">*</span></td>
                <td><input type="text" name="amount" class="form-control" value="{{old('amount')}}"></td>
            </tr>

            <tr>
                <td><label style="font-weight: bold">DETAILS</label></td>
                <td><textarea class="form-control" name="details">{{old('details')}}</textarea></td>
            </tr>

            <tr>
                <td><label style="font-weight: bold">REMARKS</label></td>
                <td><textarea class="form-control" name="remarks">{{old('remarks')}}</textarea></td>
            </tr>
        </table>
   
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to Proceed?')"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

@endsection