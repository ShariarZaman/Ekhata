<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\Customer;
use App\Model\PaymentDetail;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        return view('backend.layouts.home');
    }

     public function View(){

      $purchaseData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
      $todaypurchaseData = Purchase::whereDate('created_at', Carbon::today())->get();
      $invoiceData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
      $todayinvoiceData = Invoice::whereDate('created_at', Carbon::today())->get();
      $creditData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
      $todaycreditData = Payment::whereIn('paid_status',['full_due','partial_paid'])->whereDate('created_at', Carbon::today())->get();
      $todayprofit = InvoiceDetail::whereDate('created_at', Carbon::today())->orderBy('date','desc')->get();
      $profitdata = InvoiceDetail::orderBy('date','desc')->get();
      $customercount = Customer::count('id');
      $productcount = Product::count('id');
      $invoicecount = Invoice::count('id');
      $purchasecount = Purchase::count('id');
      
      

    return view('backend.layouts.home',compact('purchaseData','invoiceData','creditData','todaypurchaseData','todayinvoiceData','todaycreditData','todayprofit','profitdata','customercount','productcount','invoicecount','purchasecount'));
     
      

    }

     
   

   

}
