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
</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>ACCOUNT LISTS</strong></h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Account Lists<sx/li>
            </ol>
        </div>
    
    <div class="col-md-12" style="margin-top:10px">
      <a href="{{url('accounts/create')}}">
        <button class="btn btn-success btn-sm" style="background:#027647;border:1px solid #027647;" title="Create New Account"><i class="fas fa-plus fa-2x"></i></button>
      </a>  
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
        <div class="table-responsive">
                                    <table class="table color-table info-table">
                                        <thead>
                                            <tr>
                                                <th>OPEN DATE </th>
                                                <th>ACCOUNT NAME </th>
                                                <th>INITIAL AMOUNT</th>
                                                <th>TOTAL FUND</th>
                                                <th>CURRENT BALANCE</th>
                                                <th>TYPE</th>
                                                <th>DESCRIPTION</th>
                                                <th>ASSIGNED COLLECTOR</th>
                                                <th colspan="3"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($accounts as $account)
                                            <tr>
                                                <td>{{$account->open_date->format('M d Y D')}} </td>
                                                <td>{{ucwords($account->acc_name)}}</td>
                                                <td>@if(!empty($account->amount))&#8369; {{number_format($account->amount,2)}} @endif
                                                </td>

                                                <td>@if(!empty($account->current_fund))&#8369; {{number_format($account->current_fund,2)}} @endif
                                                </td>

                                                <td style="width:150px">
                                                @if(!empty($account->current_balance))&#8369; {{number_format($account->current_balance,2)}} 
                                                  @include('pages.accounts.showpercentage')

                                                @endif
                                                </td>
                                                <td>{{strtoupper($account->thetype->name)}}</td>
                                                <td>{{($account->description)}}</td>
                                                <td>@if($account->assignedto){{ucwords($account->assignedto->fullname)}}@else 
                                                 <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assignToModal{{$account->id}}"><i class="fas fa-plus"></i></button> @endif

                                              <div id="assignToModal{{$account->id}}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header" style="background:#027647;">
                                                    <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
                                             
                                                  </div>
                                                  <div class="modal-body">
                                                    {{ Form::open(array('url' => 'accounts/assignedto/' . $account->id,'method' => 'POST')) }}
                                                     <select class="form-control custom-select" id="assigned_to" name="assigned_to">
                                                        <option value="">-- Select Collector --</option>
                                                        @foreach($collectors as $collector)
                                                        <option value="{{$collector->id}}">{{ucwords($collector->fullname)}}</option>
                                                       @endforeach
                                                    </select>
                                               
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to Proceed?')"><i class="fa fa-check"></i> Save</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                         {!! Form::close() !!}
                                                  </div>
                                                </div>

                                              </div>
                                            </div>





                                               </td>
                     

                                                <td style="text-align:center">
                                                  {!! Form::open(['method'=>'GET', 'action' => ['AccountController@show',  $account->id]]) !!}
                                                  <button class="btn btn-success btn-sm" title="View {{ ucwords($account->acc_name) }} cash flow"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                                                  {!! Form::close() !!}
                                              </td>
                                                <td style="text-align:center">{!! Form::open(['method'=>'GET', 'action' => ['AccountController@edit', $account->id]]) !!}
                                                <button title="Edit {{ ucwords($account->acc_name) }} " class="btn btn-warning btn-sm"><span style="font-weight: bold"><i class="fas fa-pencil-alt"></i></span></button>
                                              {!! Form::close() !!}
                                              </td>

                                              <td >
                                                     {!! Form::open(['method'=>'DELETE', 'action' => ['AccountController@destroy', $account->id]]) !!}
                                                       <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ ucwords($account->acc_name) }}">
                                                        <span style="font-weight: bold"><i class="fa fa-times"></i></span>
                                                       </button>
                                                      {!! Form::close() !!}
                                                 </td> 

                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
    </div><!--div11-->
</div>
@endsection
