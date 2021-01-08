<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use DB;
use Auth;
use PDF;


class AnalysisController extends Controller
{
    public function profitReport(){
     
      $allData = InvoiceDetail::orderBy('date','desc')->latest('created_at')->get();
      return view('backend.analysis.view-profit',compact('allData'));

    }

    public function dailyProfitReport(){
     
      $allData = InvoiceDetail::orderBy('date','desc')->get();
      return view('backend.analysis.view-daily-profit',compact('allData'));

    }
     public function dailyProfitReportPdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['allData'] = InvoiceDetail::whereBetween('date',[$sdate,$edate])->get();
        $data['start_date']=date('Y-m-d',strtotime($request->start_date));
        $data['end_date']=date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily-profit-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('ProfitReport.pdf');

      }

    
   

}
