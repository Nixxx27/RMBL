@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>NEW LOAN ACCOUNT</strong></h3>
            <a href="{{url('accounts')}}"><button class="btn btn-info btn-sm" style="margin-bottom:5px"><i class="fas fa-chevron-left"></i> Back</button>
                </a>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('accounts')}}">Accounts</a></li>
                <li class="breadcrumb-item active">New</li>
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
<div class="row">
          <div class="col-md-12">
            @include('errors.with_error')
            @include('errors.success')
        </div>

    <div class="col-md-12">
        <div class="card">
                           <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white" style="font-weight: bold"><i class="fas fa-align-left"></i> ACCOUNT DETAILS </h4>
                            </div>
                            <div class="card-body">
                            {!! Form::open(array('name'=>'add_loan','id'=>'add_loan','files'=>true,'action'=>'AccountController@store')) !!}
                                    <div class="form-body">
                                         

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Open Date <span style="color:red">*</span></label>
                                                    <input type="text" name="open_date" id="open_date" class="form-control mdate" placeholder="Y-m-d" value="{{date('Y-m-d')}}" >
                                                </div>
                                            </div>

                                        </div>
                                        <!--/row-->


                                      <div class="row p-t-5">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Account Name </label>
                                                    <input type="text" id="acc_name" name="acc_name" value="{{old('acc_name')}}" class="form-control " placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->

                                        </div>
                                        <div class="row p-t-5">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Initial Amount <span style="color:red">*</span></label>
                                                    <input type="text" id="amount" name="amount" value="{{old('amount')}}" class="form-control " placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                             </div>
                                        <div class="row p-t-5">
                                     
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Type </label>
                                                    <select class="form-control custom-select" id="type_id" name="type_id">
                                                        <option value="">--Please Select--</option>
                                                       @foreach($types as $type)
                                                        <option value="{{$type->id}}">{{ucwords($type->name)}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
      
                                        <div class="row p-t-5">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Assigned to (optional)     
                    <a href="{{url('collectors/create')}}">
          <button type="button" class="btn btn-success btn-xs" style="background:#027647;border:1px solid #027647;" title="Add New Collector"><i class="fas fa-plus"></i></button>
      </a>      </label>
                                                    <select class="form-control custom-select" id="assigned_to" name="assigned_to">
                                                        <option value="">-- Select Collector --</option>
                                                        @foreach($collectors as $collector)
                                                        <option value="{{$collector->id}}">{{ucwords($collector->fullname)}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                          </div>
                                        <!--/row-->  



                                        <div class="row p-t-5">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Description</label>
                                                    <textarea class="form-control" rows="6" id="description" name="description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                            <!--/span-->

                                        </div>
                                        <div class="row p-t-5">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Remarks</label>
                                                    <textarea class="form-control" rows="6" name="remarks">{{old('remarks')}}</textarea>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" onclick="return confirm('Are you sure you want to add this Employee?')" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <a href="{{url('accounts')}}">
                                        <button type="button" class="btn btn-inverse" onclick="return confirm('Are you sure you want to Cancel Transaction?')">Cancel</button>
                                        </a>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
    </div>
    
</div><!--R O W -->
@endsection