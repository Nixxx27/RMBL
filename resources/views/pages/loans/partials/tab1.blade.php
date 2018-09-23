                               
           <input type="hidden" name="is_new" id="is_new" value="{{old('is_new')}}">
                     <input type="hidden" class="form-control" name="borrower_id" id="borrower_id">
                     
                                    <input type="hidden" class="form-control" name="lname" id="lname">
                                    
                                    <input type="hidden" class="form-control" name="fname" id="fname">
                        <div id="search_borrower">
                           
                            <div class="row p-t-20">
                                <div class="col-md-10">
                         
                          

                                <input type="text" class="form-control" autocomplete="off" autocomplete="none" name="borrower_name_x" id="borrower_name_x" onkeyup="borrowersULFunction();search_borrowers()" placeholder="Search Name">
                                
                                 <ul id="lastnameUL" class="full-size FixedHeightContainer" style="display:none;cursor:pointer">
                                    
                                       @foreach($borrowers as $borrower)
                                            <li><a onclick="completeBorrowerName('{{ltrim(rtrim($borrower->lname))}}','{{ltrim(rtrim($borrower->fname))}}');search_borrowers()">{{ltrim(rtrim($borrower->lname))}},{{ltrim(rtrim($borrower->fname))}}</a></li>
                                        @endforeach
                         
                                </ul>

                                </div><!--div 10-->

                                <div class="col-md-2"><label>or </label>
                                    <button class="btn btn-info" type="button" onclick="createNew(1)" title="Add New Borrower">Create New</button>
                                </div>
                            </div>
                            


                         <div class="row p-t-30">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><strong>ADDRESS</strong></label>
                                        <h4 id="result_address" class="h-blue"></h4>
                                    </div>
                                </div>
                                <!--/span-->
                        </div>
                        <div class="row p-t-5">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>AGE</strong></label>
                                        <h4 id="result_age" class="h-blue">-</h4>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>GENDER</strong></label>
                                        <h4 id="result_gender" class="h-blue">-</h4>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        <div class="row p-t-5">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>PHONE</strong></label>
                                        <h4 id="result_phone" class="h-blue">-</h4>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>MOBILE</strong></label>
                                        <h4 id="result_mobile" class="h-blue">-</h4>
                                    </div>
                                </div>
                                <!--/span-->
                                </div>
                        <div class="row p-t-5">

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>EMAIL</strong></label>
                                        <h4 id="result_eadd" class="h-blue">-</h4>
                                    </div>
                                </div>
                                <!--/span-->

                        </div><!---row p-t-20-->
                    </div><!--search_borrower-->

                <div id="new_borrower" style="display:">
                    <h3 class="card-title p-t-20"><strong><i class="fas fa-user"></i> CREATE NEW BORROWER</strong></h3>
                   
             
                                        <div class="row p-t-10">
                                        <div class="col-md-10"></div>
                                        <div class="col-md-2"><label>  &nbsp;&nbsp; </label>
                                            <button class="btn btn-info" type="button" title="Search Borrower" onclick="createNew(0)">Search</button>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" onkeyup="new_borrower();summary_content()" name="new_lname" id="new_lname" class="form-control" placeholder="" value="{{old('new_lname')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" onkeyup="new_borrower();summary_content()" name="new_fname" id="new_fname"  class="form-control" placeholder="" value="{{old('new_fname')}}">
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Middle Name</label>
                                                    <input type="text" id="mname" name="mname" class="form-control" placeholder="" value="{{old('mname')}}">
                                                </div>
                                            </div>
                                            <!--/span-->

                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label class="control-label">Gender</label>
                                                    <select class="form-control custom-select" name="gender" id="gender">
                                                        @if(old('gender')=='female')
                                                        <option value="male" >Male</option>
                                                        <option value="female" selected>Female</option>
                                                        @else
                                                        <option value="male" selected>Male</option>
                                                        <option value="female" >Female</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Age</label>
                                                    <input type="text" id="age" name="age" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" id="address" name="address" class="form-control" placeholder="">
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

                                         <div class="row p-t-5">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Remarks</label>
                                                    <textarea class="form-control" rows="3" name="remarks">{{old('remarks')}}</textarea>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                </div><!--new_borrower-->
                                    