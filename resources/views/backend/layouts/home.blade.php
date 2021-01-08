@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ekhata Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Total Purchase</h3>
                 @php
                  $total_purchase = '0';
                  @endphp

                  @foreach($purchaseData as $purchase)
                    @php
                       $total_purchase += $purchase->buying_price;
                       @endphp
                  @endforeach
                <h4>{{$total_purchase}} Tk</h4>
                <h3>Today Purchase</h3>
               @php
                  $today_purchase = '0';
                  @endphp

                  @foreach($todaypurchaseData as $purchase)
                    @php
                       $today_purchase += $purchase->buying_price;
                       @endphp
                  @endforeach
                <h4>{{$today_purchase}} Tk</h4>
              </div>

              <div class="icon">
                <i  class='fas fa-shopping-cart' style='font-size:38px;color:black'></i>
              </div>
              <a href="{{route('purchase.report')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Total Sell</h3>
                  @php
                  $total_invoice = '0';
                  @endphp

                  @foreach($invoiceData as  $invoice)
                    @php
                       $total_invoice += $invoice['payment']['total_amount'];
                       @endphp
                  @endforeach
                <h4>{{$total_invoice}} Tk</h4>
                <h3>Today Sell</h3>
                  @php
                  $today_invoice = '0';
                  @endphp

                  @foreach($todayinvoiceData as  $invoice)
                    @php
                       $today_invoice += $invoice['payment']['total_amount'];
                       @endphp
                  @endforeach
                <h4>{{$today_invoice}} Tk</h4>
              </div>
              <div class="icon">
                <i class='fas fa-shopping-bag' style='font-size:38px;color:black'></i>
              </div>
              <a href="{{route('invoice.daily.report')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Total Credit</h3>
                 @php
                  $total_due = '0';
                  @endphp
                  @foreach($creditData as $key=> $payment)
                     @php
                       $total_due += $payment->due_amount;
                       @endphp
                  @endforeach
                <h4>{{$total_due}} Tk</h4>
                <h3>Today Credit</h3>
                 @php
                  $today_due = '0';
                  @endphp
                  @foreach($todaycreditData as $key=> $payment)
                     @php
                       $today_due += $payment->due_amount;
                       @endphp
                  @endforeach
                <h4>{{$today_due}} Tk</h4>
                
              </div>
              <div class="icon">
                <i class='fas fa-lira-sign' style='font-size:38px;color:black'></i>
              </div>
              <a href="{{route('customers.credit')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->

            <div class="small-box bg-success">
              <div class="inner">
                <h3>Total Profit</h3>
                @php
                  $total_profit = '0';
                  $grand_total_profit= '0';
                  @endphp

                  @foreach($profitdata as $key=>  $profitreport)

                   @php
                   $buy_price = App\Model\Purchase::where('category_id',$profitreport->category_id)->where('product_id',$profitreport->product_id)->value('unit_price');

                   $discount_price = App\Model\Payment::where('invoice_id',$profitreport->invoice_id)->value('discount_amount');


                   $profit = (($profitreport->unit_price-$buy_price)*$profitreport->selling_qty);
                   $total_profit = $profit- $discount_price;
                   
                   @endphp
                   @php
                       $grand_total_profit += $total_profit;
                   @endphp

                  @endforeach

                
                <h4>{{$grand_total_profit}} Tk</h4>
                <h3>Today Profit</h3>
                @php
                  $today_total_profit = '0';
                  $today_grand_total_profit= '0';
                  @endphp

                  @foreach($todayprofit as $key=>  $profitreport)

                   @php
                   $buy_price = App\Model\Purchase::where('category_id',$profitreport->category_id)->where('product_id',$profitreport->product_id)->value('unit_price');

                   $today_discount_price = App\Model\Payment::where('invoice_id',$profitreport->invoice_id)->value('discount_amount');


                   $today_profit = (($profitreport->unit_price-$buy_price)*$profitreport->selling_qty);
                   $today_total_profit = $today_profit- $today_discount_price;
                   
                   @endphp
                   @php
                       $today_grand_total_profit += $today_total_profit;
                   @endphp

                  @endforeach
                
                <h4>{{$today_grand_total_profit}} Tk</h4>
                
              </div>
              <div class="icon">
                <i class='fas fa-calculator' style='font-size:48px;color:black'></i>
              </div>
              <a href="{{route('analysis.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Customer</h3>
                <h3>{{$customercount}}</h3>
              </div>
              <div class="icon">
                <i class='fas fa-users' style='font-size:48px;color:black'></i>
              </div>
              <a href="{{route('customers.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Product</h3>
                <h3>{{$productcount}}</h3>
              </div>
              <div class="icon">
                <i class='fas fa-box-open' style='font-size:48px;color:black'></i>
              </div>
              <a href="{{route('products.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Invoice</h3>
                <h3>{{$invoicecount}}</h3>
              </div>
              <div class="icon">
                <i class='fas fa-clipboard-check' style='font-size:48px;color:black'></i>
              </div>
              <a href="{{route('invoice.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Purchase</h3>
                <h3>{{$purchasecount}}</h3>
              </div>
              <div class="icon">
                <i class='fas fa-shipping-fast' style='font-size:48px;color:black'></i>
              </div>
              <a href="{{route('purchase.view')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
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