<!DOCTYPE html>
<html>
<head>
	<title>Daily Profit Report</title>
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
							<td><strong><span style="font-size: 15px;">Daily Profit Report ({{date('d-m-Y',strtotime($start_date))}} - {{date('d-m-Y',strtotime($end_date))}})</span></strong></td>
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
                    <th>Date</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Buy Rate</th>
                    <th>Sell Rate</th>
                    <th>Qty</th>
                    <th>Profit</th>
                  </tr>
                </thead>
                <tbody>
                	 @php
                  $total_profit = '0';
                  $grand_total_profit= '0';
                  @endphp
                  @foreach($allData as $key=>  $profitreport)
                   @php
                   $buy_price = App\Model\Purchase::where('category_id',$profitreport->category_id)->where('product_id',$profitreport->product_id)->value('unit_price');

                   $discount_price = App\Model\Payment::where('invoice_id',$profitreport->invoice_id)->value('discount_amount');


                   $profit = (($profitreport->unit_price-$buy_price)*$profitreport->selling_qty);
                   $total_profit = $profit- $discount_price;
                   @endphp
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{date('d-m-Y',strtotime($profitreport->date))}}</td>
                    <td>{{$profitreport['category']['name']}}</td>
                    <td>{{$profitreport['product']['name']}}</td>
                    <td>{{$buy_price}}</td>
                    <td>{{$profitreport->unit_price}}</td>
                    <td>{{$profitreport->selling_qty}}</td>
                    <td>{{$total_profit}}</td>
                  </tr>
                   @php
                       $grand_total_profit += $total_profit;
                   @endphp
                  @endforeach
                  <tbody>
                  <tr>
                    <td colspan="7" style="text-align: right;"><strong>Grand Total</strong></td>
                    <td><strong>{{$grand_total_profit}} Tk</strong></td>
                  </tr>
                </tbody>
                 </table>
                  @php
                $date = new DateTime('now', new DateTimeZone('Asia/dhaka'));
                @endphp
                <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>
             </div>
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