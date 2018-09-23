@extends('layouts.app_template')
@section('css')
<style type="text/css">
 table {border-collapse:collapse; table-layout:fixed;}
    thead th{
        font-size:13px;
         text-align: center;
    }
    tbody td {
        font-size: 12px;
        border:solid 1px #fab;
        text-align: center;
    }

  /*  .table td, .table th {
    border-color: #948d8d !important;
    }*/

    .wraptd {border:solid 1px #fab; width:150px; word-wrap:break-word;}

    .small-td
    { width:80px; word-wrap:break-word;
    }
</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>COLLECTOR LISTS</strong></h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Collector Lists</li>
            </ol>
        </div>
    
       <div class="col-md-12" style="margin-top:10px">
            <a href="{{url('collectors/create')}}">
        <button class="btn btn-success btn-sm" style="background:#027647;border:1px solid #027647;" title="Add New Collector"><i class="fas fa-plus fa-2x"></i></button>
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

            <table class="table color-bordered-table info-bordered-table">
                <thead>
                    <tr>
                       <th>Fullname</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($collectors as $collector)
                        <tr>
                            <td>{{ucwords($collector->fullname)}}</td>
                            <td class="wraptd">{{ $collector->address}}</td>
                            <td>{{ $collector->phone}}</td>
                            <td>{{ $collector->mobile}}</td>
                            <td>{{ $collector->email}}</td>
                            <td>{{ $collector->name}}</td>
                           
                             

                             <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                     <div class="dropdown-menu animated flipInX" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                        <table class="dropdown-item">
                            <tr>
                                <td>
                                 {!! Form::open(['method'=>'GET', 'action' => ['CollectorController@edit', $collector->id]]) !!}
                                    <button class="btn waves-effect btn-sm waves-light btn-info" title="Click to Edit {{ ucwords($collector->fullname)}}?">
                                    <i class="fas fa-edit fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>
                                <td>
                                {!! Form::open(['method'=>'DELETE', 'action' => ['CollectorController@destroy', $collector->id]]) !!}
                                   <button class="btn waves-effect btn-sm  waves-light btn-danger" onclick="return confirm('Are you sure you want to delete {{ucwords($collector->fullname)}} ?')" title="Click to Delete{{ucwords($collector->fullname)}}?">
                                    <i class="fa fa-times fa-2x"></i>
                                   </button>
                                  {!! Form::close() !!}
                                </td>
                             </tr>
                       </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                                        </tbody>
                                    </table>
                                </div>

</div>
@endsection



