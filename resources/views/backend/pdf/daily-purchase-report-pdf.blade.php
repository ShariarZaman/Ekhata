<!DOCTYPE html>
<html>
<head>
	<title>Daily Purchase Report</title>
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
							<td width="25%"></td>
							<td>
							<td><strong><span style="font-size: 15px;">Daily Purchase Report ({{date('d-m-Y',strtotime($start_date))}} - {{date('d-m-Y',strtotime($end_date))}})</span></strong></td>
							</td>
							<td ></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
     <div class="row">
     	<div class="col-md-12">
     		 <table width="100%" border="1">
                 <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price(Tk)</th>
                    <th>Total Price</th>

                  </tr>
                </thead>
                <tbody>
                	@php
                	$total_sum = '0';
                	@endphp
                  @foreach($allData as $key=> $purchase)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$purchase->purchase_no}}</td>
                    <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                    <td>{{$purchase['product']['name']}}</td>
                    <td>
                      {{$purchase->buying_qty}}
                      {{$purchase['product']['unit']['name']}}
                    </td>
                    <td>{{$purchase->unit_price}}</td>
                    <td>{{$purchase->buying_price}}</td>
                    @php
                    $total_sum += $purchase->buying_price;
                    @endphp
                  </tr>
                  @endforeach
                  <tr>
                  	<td colspan="6" style="text-align: right;"><strong>Grand Total</strong></td>
                  	<td><strong>{{$total_sum}}Tk</strong></td>
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