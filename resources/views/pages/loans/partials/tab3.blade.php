 
	<div class="row">
		<div class="col-md-12">
			<h3><STRONG>LOAN SUMMARY</STRONG></h3>
			<br>
			<table class="table table-condensed">
				<tr>
					<td style="font-weight: bold">BORROWER :</td>
					<td><span id="summary_name"></span></td>
				</tr>

				<tr>
					<td style="font-weight: bold">PRINCIPAL AMOUNT :</td>
					<td><span id="summary_amount"></span></td>
				</tr>

				<tr>
					<td style="font-weight: bold">LOAN DATE :</td>
					<td><span id="summary_start_date"></span></td>
				</tr>

				<tr>
					<td style="font-weight: bold"><span id="summary_label">MONTHS</span> TO PAY :</td>
					<td><span id="summary_term"></span></td>
				</tr>

				<tr>
					<td style="font-weight: bold">INTEREST RATE :</td>
					<td><span id="summary_interest"></span></td>
				</tr>

					<tr>
					<td style="font-weight: bold">MONTHLY INTEREST :</td>
					<td><span id="summary_monthly_interest"></span></td>
				</tr>

				{{-- <tr>
					<td style="font-weight: bold">SCHEDULE :</td>
					<td><span id="summary_sched"></span></td>
				</tr> --}}

				<tr>
					<td style="font-weight: bold">TOTAL INTEREST :</td>
					<td><span id="summary_total_interest"></span></td>
				</tr>


				<tr>
					<td style="font-weight: bold">TOTAL LOAN :</td>
					<td><span id="summary_total_loan"></span></td>
				</tr>

				

				<tr>
					<td style="font-weight: bold"><span id="summary_sched_label"></span> AMORTIZATION :</td>
					<td><span id="summary_monthly_amortization"></span></td>
				</tr>

			

				<tr>
					<td style="font-weight: bold">REMARKS :</td>
					<td><span id="summary_remarks"></span></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
   <div class="form-actions">
                                        <button type="submit" onclick="return confirm('Are you sure you want to create this Loan?')" class="btn btn-success btn-lg pull-right"> <i class="fa fa-check"></i> CONFIRM</button>
                        {{--                 <button type="button" class="btn btn-inverse btn-lg">Cancel</button> --}}
                                    </div>