<!DOCTYPE html>
<html>
<head>
	<title>Supplier Wise Stock Report Pdf</title>
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
							<td width="52%"></td>
							<td>
							<td><strong><span style="font-size: 15px;">Supplier Wise Stock Report</span></strong></td>
							</td>
							<td ></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
     <div class="row">
     	<div class="col-md-12">
            <strong>Supplier Name : </strong> {{$allData['0']['supplier']['name']}}
     		 <table border="1" width="100%">
     		 	
                 <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
                    <th>Unit</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach($allData as $key=> $product)
                   @php
                  $buying_total = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');

                  $selling_total = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                  @endphp
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$product['category']['name']}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$buying_total}}</td>
                    <td>{{$selling_total}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product['unit']['name']}}</td>
                    
                  </tr>
                  @endforeach
                </tbody>
                 </table>
     	</div>
     	 @php
                $date = new DateTime('now', new DateTimeZone('Asia/dhaka'));
                @endphp
                <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>
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
						    <p style="text-align: center; border-bottom: 1px solid #000;"><br/>Owner Signature</p>
							</td>
						</tr>
					</tbody>
					
				</table>
				
			</div>


		</div>

	</div>

</body>
</html>