@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
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
                <h3>Purchase List 

                
                 <a class="btn btn-success float-right btn small " href="{{route('purchase.add')}}"><i class=" fa fa-plus-circle "> </i> Add Purchase</a>
                 
                </h3>

              </div><!-- /.card-header -->
              <div class="card-body">
                
                <table id="example1" class="table table-bordered table-hover table-responsive">
                 <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price(Tk)</th>
                    <th>Buying Price(Tk)</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  <!-- mytest -->
                  @php
                  $total_purchase = '0';
                  @endphp
                  <!-- mytest -->

                  @foreach($allData as $key=> $purchase)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$purchase->purchase_no}}</td>
                    <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                    <td>{{$purchase['supplier']['name']}}</td>
                    <td>{{$purchase['category']['name']}}
                    <td>{{$purchase['product']['name']}}</td>
                    <td>{{$purchase->description}}</td>
                    <td>
                      {{$purchase->buying_qty}}
                      {{$purchase['product']['unit']['name']}}
                    </td>
                    <td>{{$purchase->unit_price}}</td>
                    <td>{{$purchase->buying_price}}</td>
                    <td>
                      @if($purchase->status=='0')
                      <span style="background: #FC4236;padding: 5px;">Pending</span>
                      @elseif($purchase->status=='1')
                      <span style="background: #5EAB00;padding: 5px;">Approved</span>
                      @endif
                    </td>
                   
                       
                    <td>
                      @if($purchase->status=='0')
                      <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{route('purchase.delete',$purchase->id)}}"><i class="fa fa-trash"></i></a>
                      @endif
                    </td>
                   <!--  mytest -->
                    @php
                       $total_purchase += $purchase->buying_price;
                       @endphp
                        <!--  mytest -->
                  </tr>
                  @endforeach
                </tbody>
                 </table>
                 <table  class="table table-bordered table-hover">
                <tbody>
                  <tr>
                    <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                    <td><strong>{{$total_purchase}} Tk</strong></td>
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