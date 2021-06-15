<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Suplier;
use App\Model\Unit;
use App\Model\Product;
use App\Model\purchase;
use Auth;
use DB;
use PDF;

class StockController extends Controller
{
    public function stockReport()
    {
    	$allData = Product::orderBy('suplier_id', 'asc')->orderBy('category_id','asc')->get();
    	return view('backend.stock.stock-report',compact('allData') );
    }

    public function stockReportPdf()
    {
    	$data['allData'] = Product::orderBy('suplier_id', 'asc')->orderBy('category_id','asc')->get();
        $pdf = PDF::loadView('backend.pdf.stock-pdf-report', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function supliedProductWise()
    {   
    	$data['suppliers'] = Suplier::all();
    	$data['categories'] = Category::all();
    	return view('backend.stock.suplier-product-wise', $data );
    }

    public function supliedWisePdf(Request $request )
    {
    	$data['allData'] = Product::orderBy('suplier_id', 'asc')->orderBy('category_id','asc')->where('suplier_id', $request->suplier_id)->get();
        $pdf = PDF::loadView('backend.pdf.suplier-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function productWisePdf(Request $request )
    {
        $data['product'] = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        $pdf = PDF::loadView('backend.pdf.product-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
 }
