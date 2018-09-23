@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
             <h3 class="text-themecolor" style="color:#1BA196"><strong>NEW COLLECTOR</strong></h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('collectors')}}">Collector Lists</a></li>
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
                                <h4 class="m-b-0 text-white">Collectors Info</h4>
                            </div>
                            <div class="card-body">
                            {!! Form::open(array('name'=>'add_collector','id'=>'add_collector','files'=>true,'action'=>'CollectorController@store')) !!}
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Full Name <span style="color:red">*</span></label>
                                                    <input type="text" id="fullname" name="fullname" class="form-control"  value="{{old('fullname')}}">
                                                </div>
                                            </div>
                                             <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="control-label">Username <span style="color:red">*</span></label>
                                                    <input type="text" id="name" name="name" class="form-control"  value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Address </label>
                                                    <input type="text" id="address" name="address" value="{{old('address')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->


                                        <div class="row p-t-5">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Phone </label>
                                                    <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-4">
                                                <div class="form-groupr">
                                                    <label class="control-label">Mobile </label>
                                                    <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-groupr">
                                                    <label class="control-label">Email </label>
                                                    <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" onclick="return confirm('Are you sure you want to add this Collector?')" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
    </div>
    
</div><!--R O W -->
@endsection


