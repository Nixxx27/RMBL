@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
             <h3 class="text-themecolor" style="color:#1BA196"><strong>INTEREST RATE</strong></h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Interest Rate Page</li>
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
    <div class="col-md-1"></div>
    <div class="col-md-14">
        <h3>DEFAULT INTEREST RATE %</h3>
            {{ Form::open(array('url' => 'interest/update/' . $interest->id,'method' => 'POST')) }}
        <input type="text" name="interest" value="{{$interest->interest}}" class="form-control">
        <BR><br>
        <BUTTON class="btn btn-md btn-info" onclick="return confirm('Are you sure you want to update Default Interest?')"><i class="fa fa-check"></i> Update</BUTTON>
            {!! Form::close() !!}
    </div>
</div>
@endsection
