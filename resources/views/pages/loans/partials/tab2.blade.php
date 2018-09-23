                                          <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>LOAN START DATE</strong> </label>
                                                    <input type="text" id="start_date" name="start_date" class="form-control mdate" placeholder="Y-m-d" value="@if(old('start_date')){{old('start_date')}}@else{{date('Y-m-d')}}@endif">
                                                </div>
                                            </div>
                                            <!--/span-->

                                           
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">

                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>LOAN AMOUNT</strong> <small id="notif_low_funds" style="color:red;font-size:11px;font-style:italic;font-weight: bold"></small> </label>
                                                    <input type="text" onkeyup="check_if_loan_is_higher_than_fund()" id="amount" name="amount" value="{{old('amount')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                       
                                        </div>
                                         <div class="row p-t-5">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>TERMS (MONTHS TO PAY)</strong> </label>
                                                  <!--   <input type="text" id="terms" name="terms" value="{{old('terms')}}" class="form-control" placeholder="# of Months"> -->
                                                   <select class="form-control custom-select" name="terms" id="terms">
                                                  <?php
                                                        for ($i=1; $i <= 60 ; $i++) { 
                                                            echo "<option>" . $i . "</option>";
                                                        }


                                                  ?>
                                                 </select>
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>INTEREST RATE %</strong></label>
                                                    <input type="text" id="rate" name="rate" value="@if(old('rate')){{old('rate')}}@else{{$interest->interest}}@endif" class="form-control" placeholder="%">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                         {{-- <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="control-label"><STRONG>COLLECTION SCHEDULE</STRONG></label>
                                                    <select class="form-control custom-select" name="sched" id="sched">
                                                        <option value="monthly">Monthly</option>
                                                        <option value="semimonthly">Semi-Monthly</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <input type="hidden" name="sched" id="sched" value="monthly">
                                        <div class="row">
                                             <div class="col-md-5">
                                                <div class="form-group">
                                                        <label  class="control-label"><strong>REMARKS</strong></label>
                                                        <textarea class="form-control" name="remarks" id="remarks" rows="5">{{old('remarks')}}</textarea>
                                                    </div>
                                            </div>


                                        </div>

                                 
                                   
                   
          

