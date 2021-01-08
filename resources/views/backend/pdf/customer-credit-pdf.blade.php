<!DOCTYPE html>
<html>
<head>
	<title>Credit Customer Report</title>
	 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="25%"></td>
							<td><span style="font-size: 30px; background: #1781BF;padding: 3px 10px 3px 10px; color: #fff;">Pallab Biponi</span>
								<br/>
								     Station Road, Joypurhat
							
						    </td>
							<td><span>Phone: +09875233 <br/>
								      Mobile: 01934534567
							</span>
						 </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px;">
				<table>
					<tbody>
						<tr>
							<td width="55%"></td>
							<td>
							<td><strong><span style="font-size: 15px;">Credit Customer Report </span></strong></td>
							</td>
							<td ></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
     <div class="row">
     	<div class="col-md-12">
     		
                   <table border="1" width="100%">
                 <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                	@php
                	$total_due = '0';
                	@endphp
                  @foreach($allData as $key=> $payment)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>
                      {{$payment['customer']['name']}}
                      ({{$payment['customer']['mobile_no']}}-{{$payment['customer']['address']}})
                    </td>
                     <td>Invoice No #{{$payment['invoice']['invoice_no']}}</td>
                      <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                       <td>{{$payment->due_amount}} Tk</td>
                       @php
                       $total_due += $payment->due_amount;
                       @endphp
                  </tr>
                  @endforeach
                  <tr>
                  	<td colspan="4" style="text-align: right;"><strong>Grand Total</strong></td>
                  	<td><strong>{{$total_due}} Tk</strong></td>
                  </tr>
                </tbody>
                 </table>
                 @php
                $date = new DateTime('now', new DateTimeZone('Asia/dhaka'));
                @endphp
                <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>

     	</div>
     	
     </div>
	<div class="row">
			<div class="col-md-12">
				
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%">
							</td>
							<td style="width: 20%"></td>
							<td style="width: 40%; text-align: center;">
						    <p style="text-align: center; border-bottom: 1px solid #000;">Owner Signature</p>
							</td>
						</tr>
					</tbody>
					
				</table>
				
			</div>


		</div>

	</div>

</body>
</html>