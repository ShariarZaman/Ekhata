<!DOCTYPE html>
<html>
<head>
	<title>Invoice Details PDF</title>
	 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td><strong>Invoice No: #{{$payment['invoice']['invoice_no']}} </strong></td>
							<td width="10%"></td>
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
							<td width="38%"></td>
							<td>
							<td><strong><span style="font-size: 15px;">Customer Invoice Details</span></strong></td>
							</td>
							<td width="30%"></td>
						</tr>
					</tbody>
					

				</table>
				
			</div>
			

		</div>
       

		<div class="row">
			<div class="col-md-12">
				<table width="100%">
                  <tbody>
                    <tr>
                      <td colspan="3"><strong>Customer Info</strong></td>
                    </tr>
                    <tr>
                      <td width="30%"><strong>Name : {{$payment['customer']['name']}}  </strong></td>
                      <td width="30%"><strong>Mobile : {{$payment['customer']['mobile_no']}}  </strong></td>
                      <td width="40%"><strong>Address : {{$payment['customer']['address']}}  </strong></td>

                    </tr>
                    

                  </tbody>
                </table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			 <table border="1" width="100%" style="margin-bottom: 10px;">
                  <thead>
                    <tr class="text-center">
                      <th>SL.</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                    </tr>

                  </thead>
                   <tbody>
                    @php
                    $total_sum = '0';
                    $invoice_details = App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                    @endphp
                    @foreach($invoice_details as $key => $details)
                     <tr class="text-center">
                       <td>{{$key+1}}</td>
                       <td>{{$details['category']['name']}}</td>
                       <td>{{$details['product']['name']}}</td>
                       <td>{{$details->selling_qty}}</td>
                       <td>{{$details->unit_price}}</td>
                       <td>{{$details->selling_price}}</td>
                     </tr>
                     @php
                      $total_sum +=$details->selling_price;
                     @endphp
                     @endforeach
                     <tr>
                       <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
                       <td class="text-center"><strong>{{$total_sum}}</strong></td>
                     </tr>

                     <tr>
                       <td colspan="5" class="text-right">Discount</td>
                       <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                     </tr>

                     <tr>
                       <td colspan="5" class="text-right">Paid Amount</td>
                       <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                     </tr>

                     <tr>
                       <td colspan="5" class="text-right">Due Amount</td>
                       <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                       <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                     </tr>

                     <tr>
                       <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
                       <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                     </tr>
                     <tr>
                     	<td colspan="6" style="text-align: center; font-weight: bold;">Paid Summary</td>
                     </tr>
                     <tr>
                     	<td colspan="3" style="text-align: right;"><strong>Date</strong></td>
                     	<td colspan="3"><strong>Amount</strong></td>
                     </tr>
                     @php
                     $payment_details = App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                     @endphp
                     @foreach($payment_details as $details)
                     <tr>
                     	<td colspan="3" style="text-align: right;">{{date('d-m-Y',strtotime($details->date))}}</td>
                     	<td colspan="3">{{$details->current_paid_amount}}</td>
                     </tr>
                     @endforeach
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
				<hr style="margin-bottom: 0px;">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%">
								<p style="text-align: center;margin-left: :20px;">Customer Signature</p>
								
							</td>
							<td style="width: 20%"></td>
							<td style="width: 40%; text-align: center;">
								<p style="text-align: center;">Seller Signature</p>
							</td>
						</tr>
					</tbody>
					
				</table>
				
			</div>


		</div>

	</div>

</body>
</html>