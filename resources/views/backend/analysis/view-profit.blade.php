@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profit Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profit Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12 ">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>Profit list 
                 <!-- <a class="btn btn-success float-right btn small " href="{{route('stock.report.pdf')}}" target="_blank"><i class=" fa fa-download "> </i> Download PDF</a> -->
                 
                </h3>

              </div><!-- /.card-header -->
              <div class="card-body">
                
                <table id="example1" class="table table-bordered table-hover">
                 <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Buy Rate(Tk)</th>
                    <th>Sell Rate(Tk)</th>
                    <th>Qty</th>
                    <th>Profit(Tk)</th>
                    <th>Profit(%)</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $total_profit = '0';
                  $grand_total_profit= '0';
                  $percentprofit='0';

                  @endphp
                  @foreach($allData as $key=>  $profitreport)
                   @php
                   $buy_price = App\Model\Purchase::where('category_id',$profitreport->category_id)->where('product_id',$profitreport->product_id)->value('unit_price');

                   $discount_price = App\Model\Payment::where('invoice_id',$profitreport->invoice_id)->value('discount_amount');


                   $profit = (($profitreport->unit_price-$buy_price)*$profitreport->selling_qty);
                   $total_profit = $profit- $discount_price;

                   $percentprofit= ($total_profit/$buy_price)*100;

                   @endphp
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{date('d-m-Y',strtotime($profitreport->date))}}</td>
                    <td>{{$profitreport['category']['name']}}</td>
                    <td>{{$profitreport['product']['name']}}</td>
                    <td>{{number_format($buy_price,2,'.','')}}</td>
                    <td>{{$profitreport->unit_price}}</td>
                    <td>{{$profitreport->selling_qty}}</td>
                    <td>{{number_format($total_profit,2,'.','')}}</td>
                    <td>{{number_format($percentprofit,4,'.','')}}</td>
                  </tr>
                   @php
                       $grand_total_profit += $total_profit;
                   @endphp
                  @endforeach
                </tbody>
                 </table>
                 <table  class="table table-bordered table-hover">
                <tbody>
                  <tr>
                    <td colspan="7" style="text-align: right;"><strong>Grand Total</strong></td>
                    <td><strong>{{$grand_total_profit}} Tk</strong></td>
                  </tr>
                </tbody>
                 </table>
              </div><!-- /.card-body -->
            </div>
            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection  