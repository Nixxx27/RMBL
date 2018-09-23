
<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{url('public/images/users/profile.png')}}" alt="user" /><span class="hide-menu"><b>{{ strtoupper(\Auth::user()->name)}}</b></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void()">My Profile </a></li>
                                <li><a href="javascript:void()">My Balance</a></li>
                                <li><a href="javascript:void()">Inbox</a></li>
                                <li><a href="javascript:void()">Account Setting</a></li>
                                <li><a href="javascript:void()">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li><a href="{{url('home')}}" href="#" aria-expanded="false"><i class="fas fa-tachometer-alt" style="color:#244354"></i> <span class="hide-menu"> Dashboard </span></a></li>

                          <li class="nav-devider"></li>

                @if(Auth::user()->is_admin())              
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="far fa-money-bill-alt" style="color:#244354"></i><span class="hide-menu"> Accounts </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('accounts/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('accounts')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                @endif
                        <li class="nav-small-cap" style="font-weight: bold;font-size: 14px">
                        FUNDS:
                         @if(view_current_funds() !=0 )&#8369;{{number_format(view_current_funds(),2)}}@else <span style="color:red">&#8369;0</span> @endif 

    
                     </li>
                       {{--  <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="fas fa-users" style="color:#244354"></i> <span class="hide-menu"> Loans </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('loans/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('loans')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li> --}}
                         <li><a href="{{url('loans')}}" href="#" aria-expanded="false"><i class="fas fa-users" style="color:#244354"></i> <span class="hide-menu">  Loans </span></a></li>


               
                     

                        {{--  <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-user" style="color:#244354"></i><span class="hide-menu"> Collectors </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('collectors/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('collectors')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li> --}}


                       {{--  <li class="nav-small-cap">EMPLOYEE LISTS</li>
                        <li><a href="{{url('patients/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li> 
                        <li><a href="{{url('patients')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li> 
 --}}
                       {{--  <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">List</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="table-basic.html">Basic Tables</a></li>
                            </ul>
                        </li> --}}
                       {{--  <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-cogs" style="color:#244354"></i><span class="hide-menu"> Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="map-google.html">Company</a></li>
                                <li><a href="map-vector.html">Department</a></li>
                            </ul>
                        </li> --}}
            
                @if( Auth::user()->is_admin() )
                        <li class=""> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-cogs" style="color:#244354"></i><span class="hide-menu"> Settings</span></a>
                            <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                <li><a href="{{url('interest')}}">Interest Rate</a></li>
                                <li class=""> <a class="has-arrow" href="#" aria-expanded="false">Collectors</a>
                                    <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                        <li><a href="{{url('collectors')}}">List</a></li>
                                        <li><a href="{{url('collectors/create')}}">New</a></li>
                                    </ul>
                                </li>
                               
                            </ul>
                        </li>
                    @endif
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>