@extends('layouts.app_template')
@section('css')
<style type="text/css">
    #lastnameUL li a:hover:not(.header) {
  background-color: #eee;
}

.h-blue{
    color:#398bf7;
    font-weight: bold;
    text-transform: uppercase;
}

#lastnameUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#lastnameUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color:#17a094;/* #f6f6f6;*/
  padding: 12px;
  text-decoration: none;
  font-size: 14px;
  color: white;
  display: block
}

#lastnameUL li a:hover:not(.header) {
    background-color: #053249; /* #eee; */
}

h4
{
    font-size:90% !important;
}
</style>

@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>NEW LOAN</strong></h3>
             <a href="{{url('loans')}}"><button class="btn btn-info btn-sm" style="margin-bottom:5px"><i class="fas fa-chevron-left"></i> Back</button>
                </a>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item">Loans</li>
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
                                <h4 class="m-b-0 text-white" style="font-weight: bold"><i class="fas fa-align-left"></i> DETAILS </h4>
                            </div>
                            <div class="card-body">
                       {!! Form::open(array('name'=>'add_loan','id'=>'add_loan','files'=>true,'action'=>'LoanController@store')) !!}    
                                    <div class="form-body">

                                <div class="card-body p-b-0">
                               
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item" style="font-weight: bold"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">1. BORROWERS INFO</span></a> </li>
                                @if(view_current_funds() !=0 )
                                    <li class="nav-item" style="font-weight: bold"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span class="hidden-sm-up"><i class="ti-menu"></i></span> <span class="hidden-xs-down">2. LOAN DETAILS</span></a> </li>
                                    <li class="nav-item" style="font-weight: bold" > <a onclick="summary_content()" class="nav-link" data-toggle="tab" href="#messages7" role="tab"><span class="hidden-sm-up"><i class="ti-save"></i></span> <span class="hidden-xs-down">3.SUMMARY & PROCEED</span></a> </li>
                               
                                @endif
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <div class="p-20">
                                            @if(view_current_funds() ==0 )
                                                <h5 style="color:red;font-weight: bold">You have &#8369;0 balance. Please ask fund to your Account Manager.</h5>
                                            @endif
                                              @include("pages.loans.partials.tab1")
                                        </div>
                                    </div><!--TAB 1-->
                                @if(view_current_funds() !=0 )
                                    <div class="tab-pane  p-20" id="profile7" role="tabpanel">
                                         @include("pages.loans.partials.tab2")
                                    </div><!--TAB 2-->
                                    <div class="tab-pane p-20" id="messages7" role="tabpanel">
                                        @include("pages.loans.partials.tab3")
                                    </div><!--TAB 3-->
                                @endif

                                </div>
                            </div>
                 </div><!--form-body--> {!! Form::close() !!}
    </div><!--card-body-->
    
</div><!--R O W -->
@endsection

@section('js')
<script type="text/javascript">
    
    function is_borrower_exist() // this function is not in use
    {
        $fname = $("#fname").val();
        $lname = $("#lname").val();
          $.ajax({
                type: "GET",
                url: "../loans/is_borrower_exist",
                data: {fname: $fname,lname: $lname},
                 dataType: 'json',
                 success: function(data) {

                    if(data.count >= 1)
                    {
                        $("#found").slideDown();
                    }else
                    {
                        $("#found").slideUp();
                    }
                    // console.log('data.id')
                    console.log(data.count);
                     $("#address").val(data.address);
                      $("#address").attr("readonly","");
                    // $('#referral').slideUp().slideDown();
                    // $("#employee_id").val(data.emp_id);
                    // $("#empidnum_show").text(data.empidnum);
                    // $("#fullname").text(data.name);
                    // $("#position").text(data.position);
                    // $("#department").text(data.department);
                    // $("#division").text(data.division);
                    // $("#shift").val(data.shift);

                    // $("#dayoff").val(data.dayoff);
                  

                    // $("#company").text(data.company);
                    // $("#dob").text(data.dob);

               
                    
                },

                error: function(data) {

                   $("#found").slideUp();
                 },



            });
    }


    function borrowers_checked($num)
    {
        console.log($num);
        if($num==1)
        {
            $("#checked_use").attr("checked","checked");
            $("#checked_edit").removeAttr("checked").removeClass("active");
            $("#checked_create").removeAttr("checked").removeClass("active");
        }else if($num==2)
        {
            $("#checked_use").removeAttr("checked").removeClass("active");
            $("#checked_edit").attr("checked","checked");
            $("#checked_create").removeAttr("checked").removeClass("active");
        }else if($num==3)
        {
            $("#checked_use").removeAttr("checked");
            $("#checked_edit").removeAttr("checked").removeClass("active");
            $("#checked_create").attr("checked","checked").removeClass("active");
        }


    }



    function borrowersULFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("borrower_name_x");
    filter = input.value.toUpperCase();
    ul = document.getElementById("lastnameUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {

            li[i].style.display = "";


        } else {
            li[i].style.display = "none";

        }
    }

    $myInput =  $("#borrower_name_x");
    $lastnameUL =  $("#lastnameUL");
    if($myInput.val() == "")
    {
        $lastnameUL.slideUp(); 
        
         // $("#no_results").html("");
        
    }else{
        $lastnameUL.slideDown(); 
        // $("#no_results").html("No Results Found : Try searching for number only, sample : 8496!")
       
    }

  
}

function borrower_name_value($name)
{
     $("#borrower_name").val($name);
}


function search_borrowers()
    {
     
         $fname = $("#fname").val();
        $lname = $("#lname").val();
         $borrower_name_x = $("#borrower_name_x").val();
        // console.log($fname);
        // console.log($lname);
        
     if($borrower_name_x.length > 0)
        {

        $.ajax({
                type: "GET",
                url: "../loans/search_borrowers",
                  data: {fname: $fname,lname: $lname,},
                 dataType: 'json',
                 success: function(data) {
                    // $('#referral').slideUp().slideDown();
                $("#borrower_id").val(data.borrower_id);

                $("#result_name").text(data.fname);
                $("#result_address").text(data.address);
                $("#result_age").text(data.age);
                $("#result_gender").text(data.gender);
                $("#result_phone").text(data.phone);
                $("#result_mobile").text(data.mobile);
                $("#result_eadd").text(data.email);
                // $("#fullname").text(data.name);
                // $("#position").text(data.position);
                // $("#department").text(data.department);
                // $("#division").text(data.division);

                // $("#shift").val(data.shift);
               
                // $("#dayoff").val(data.dayoff);
                // $("#company").text(data.company);
                //  $("#dob").text(data.dob);
                  
                },
            });

        
         
        }else{
               $("#result_name").text("");
                $("#result_address").text("");
                $("#result_age").text("");
                $("#result_gender").text("");
                $("#result_phone").text("");
                $("#result_mobile").text("");
                $("#result_eadd").text("");
        }

         $("#is_new").val(0);
    }


    function completeBorrowerName($lastname,$firstname)
    {
        // console.log($lastname);
    $("#lname").val($lastname);
     $("#fname").val($firstname);
    $("#lastnameUL").fadeOut();

    $name = $lastname + ", " + $firstname;
    $("#borrower_name_x").val($name.toUpperCase());


    search_borrowers();
    summary_content();
    }


    

    function new_borrower()
    {
        $new_lname = $("#new_lname").val();
         $new_fname = $("#new_fname").val();
        
     if($new_lname.length > 1 & $new_fname.length > 1)
        {
         $("#is_new").val(1);
        }
    }


    function createNew($num)
    {
        $("#is_new").val($num)
        $("#search_borrower").slideToggle();
        $("#new_borrower").slideToggle();
        summary_content();
    }


    $(document).ready(function(){




    if($("#is_new").val()==1)
    {
        $("#search_borrower").slideUp();
        $("#new_borrower").slideDown();
    }else{
         $("#search_borrower").slideDown();
        $("#new_borrower").slideUp();
    }

    });


    function summary_content()
    {
        if($("#is_new").val()==1)
        {
            $lname =  $("#new_lname").val();
            $fname =  $("#new_fname").val();
            $borrower_name = $lname.toUpperCase() + " ," + $fname.toUpperCase();
        }else{
             $borrower_name = $("#borrower_name_x").val() ;
        }

        $("#summary_name").text($borrower_name);
        $("#summary_amount").text( "P" + $("#amount").val() );
         $("#summary_start_date").text( $("#start_date").val() );
       
        $("#summary_interest").text( $("#rate").val() + "%");

        
         if($("#terms").val()==1)
         {
            $("#summary_term").text("1 Month");
            $('#summary_label').text("MONTH");
         }else{
             $("#summary_term").text($("#terms").val() + " Months");
             $('#summary_label').text("MONTHS");
         }
        
        $("#summary_remarks").text( $("#remarks").val() );

        if($("#sched").val()=="monthly")
        {
            $("#summary_sched").text("Monthly");
            $("#summary_sched_label").text("MONTHLY");
        }else{
            $("#summary_sched").text("Semi-monthly");
            $("#summary_sched_label").text("SEMI-MONTHLY");
        }
        

        $interest_divided_by_100 =  $("#rate").val() / 100; // 5% / 100
        $monthly_interest = $interest_divided_by_100 * $("#amount").val();
        $multiply_num_of_months =  $monthly_interest * $("#terms").val();
        $total_amount =parseInt( $("#amount").val()) + parseInt($multiply_num_of_months);
        $("#summary_total_loan").text("P" + $total_amount);
        $("#summary_total_interest").text("P" + $multiply_num_of_months);

         $("#summary_monthly_interest").text("P" + $monthly_interest);


        if($("#sched").val()=="semimonthly")
        {
            $sched =  $("#terms").val() * 2;
        }else{
            $sched =  $("#terms").val();
        }
        $("#summary_monthly_amortization").text( "P" + $total_amount / $sched)
        
    }

    function check_if_loan_is_higher_than_fund()
    {


        $amount = $("#amount").val();
        $available_funds = {{ view_current_funds() }};

        console.log($amount +  " " + $available_funds);
        if($amount > $available_funds )
        {
            $("#notif_low_funds").text("Loan amount is greater than Available Funds.");
        }else{
            $("#notif_low_funds").text("");
        }
        
    }


</script>
@endsection