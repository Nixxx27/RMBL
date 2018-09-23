@extends('layouts.app_template')

@section('css')
<style type="text/css">
    th{
       font-weight: bold !important;
        font-size: 14px !important;
        text-align: center !important;
       /*text-transform: uppercase;*/
    }
    table{
        font-size: 12px;
    }
</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>LOAN</strong></h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Loan<sx/li>
            </ol>
        </div>
    <div class="col-md-10"></div>
    <div class="col-md-2">
       <button class="btn btn-inverse btn-sm" id="linkText" onclick="toggleSummary()">View Summary</button>
    </div>    

    
    
  <div class="col-md-12">
      <a href="{{url('loans/create')}}">
        <button class="btn btn-success btn-sm" style="background:#027647;border:1px solid #027647;" title="Create New Loan"><i class="fas fa-plus fa-2x"></i></button>
      </a>  
    </div>
</div>
 <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<hr>
<div class="row" id="loanSummary" style="display:none;">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box"  style="border-bottom:4px solid #00C0EF">
            <div style="text-align: center;padding-top:10px">
              <span class="info-box-text">PRINCIPAL AMOUNT :</span>
              <span class="info-box-number">@if(!empty($totalLoanAmount[0]->ttl))&#8369; {{number_format($totalLoanAmount[0]->ttl,2)}} @endif</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" style="border-bottom:4px solid red">
             <div style="text-align: center;padding-top:10px">
              <span class="info-box-text">TOTAL LOANS W/ INTEREST :</span>
              <span class="info-box-number">@if(!empty($totalForCollection[0]->ttl))&#8369; {{number_format($totalForCollection[0]->ttl,2)}} @endif</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" style="border-bottom:4px solid #00A65A">
            <div style="text-align: center;padding-top:10px">
              <span class="info-box-text">TOTAL INTEREST</span>
              <span class="info-box-number">@if(!empty($totalInterest))&#8369; {{number_format($totalInterest,2)}} @endif</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      </div><!--loanSummary-->
<div class="row">

     <div class="col-md-12">
        <div class="table-responsive">
                                    <table class="table color-table info-table">
                                        <thead>
                                            <tr>
                                                <th>REF #</th>
                                                <th>BORROWERS NAME </th>
                                                <th>RELEASED </th>
                                                <th>MATURITY</th>
                                                <th>PRINCIPAL</th>
                                                <th>TOTAL LOAN</th> 
                                                <th>CURRENT BALANCE</th>
                                              @if(Auth::user()->is_admin()) <th>CREATED BY</th>@endif
                                                <th>REMARKS</th>
                                                <th>STATUS</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($loans as $loan)
                                            <tr>
                                                <td>{{$loan->ref_num}}</td>
                                                <td>{{ucwords($loan->theborrower->lname)}},{{ucwords($loan->theborrower->fname)}},{{ucwords($loan->theborrower->mname)}} </td>
                                                <!--released-->
                                                <td>{{$loan->start_date->format('M d Y D')}} </td>
                                                <!--maturity-->
                                                <td>{{$loan->maturity->format('M d Y')}} </td>
                                                <!--principal-->
                                                <td style="width:130px;background:#ededed;text-align:center;border-bottom:1px solid white">@if(!empty($loan->amount))&#8369; {{number_format($loan->amount,2)}} @endif 
                                                  <br> <span style="font-weight: bold;font-size: 11px">@ {{$loan->rate}}% per 
                                                    @if($loan->sched=='monthly')month @else Semi-Monthly @endif <br> {{$loan->terms}} @if($loan->terms==1) mo. @else mos. @endif to pay</span></td>
                                                <!--TOTAL LOAN-->
                                                <td style="width:100px">@if(!empty($loan->total_loan))&#8369;{{number_format($loan->total_loan,2)}} @endif </td>
                                                <!--balance-->
                                                <td style="width:100px">@if(!empty($loan->balance))&#8369;{{number_format($loan->balance,2)}} @endif </td>

                                              @if(Auth::user()->is_admin())
                                                <td>{{ucwords($loan->thecollector->fullname)}}</td>
                                              @endif
                                                <td>{{$loan->remarks}}</td>
                                                <td>{{strtoupper($loan->status)}}</td>
                                                <td>
                                                  {!! Form::open(['method'=>'GET', 'action' => ['LoanController@show',  $loan->id]]) !!}
                                                  <button class="btn btn-success " title="view {{ ucwords($loan->acc_name) }} Details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                                                  {!! Form::close() !!}
                                             </td>
                                              {{--    <td style="text-align:center">{!! Form::open(['method'=>'GET', 'action' => ['LoanController@edit', $loan->id]]) !!}
                                                <button title="Edit Loan of {{ucwords($loan->theborrower->lname)}},{{ucwords($loan->theborrower->fname)}},{{ucwords($loan->theborrower->mname)}}" class="btn btn-warning "><span style="font-weight: bold"><i class="fas fa-pencil-alt"></i></span></button>
                                              {!! Form::close() !!}
                                              </td> --}}

                                             {{--  <td >
                                                     {!! Form::open(['method'=>'DELETE', 'action' => ['LoanController@destroy', $loan->id]]) !!}
                                                       <button class="btn btn-danger " onclick="return confirm('Are you sure you want to delete this Loan?')" title="Delete Loan of {{ucwords($loan->theborrower->lname)}},{{ucwords($loan->theborrower->fname)}},{{ucwords($loan->theborrower->mname)}}">
                                                        <span style="font-weight: bold"><i class="fa fa-times"></i></span>
                                                       </button>
                                                      {!! Form::close() !!}
                                                 </td>  --}}

                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
    </div><!--div11-->

    <div class="col-md-4"></div>
    <div class="col-md-8" style="margin-bottom:20px">
     {!! $loans->render() !!}

</div>
</div>
@endsection

@section('js')

<script type="text/javascript">
  function toggleSummary()
  {
   $('#loanSummary').slideToggle('slow',callbackFn);
  }

  function callbackFn()
  {
    var $link =$('#linkText');

    $(this).is(":visible") ? $link.text('Close Summary') : $link.text('View Summary') ;
  }
</script>

@endsection
