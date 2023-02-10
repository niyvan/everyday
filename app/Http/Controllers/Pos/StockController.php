<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StockController extends Controller
{
    public function StockReport()
    {
        $allData = Product::orderBy('category_id', 'asc')->get();
        return view('admin.stock.stock_report', compact('allData'));
    } // End Method

    public function StockReportPdf()
    {
        $allData = Product::orderBy('category_id', 'asc')->get();
        return view('admin.pdf.stock_report_pdf', compact('allData'));
    } // End Method

    public function StockProductWise()
    {
        $category = Category::all();
        return view('admin.stock.product_wise_report', compact('category'));
    } // End Method

    public function ProductWisePdf(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        if ($request->start_date != null && $request->end_date != null) {
            if ($request->category_id == 'All' && ($request->product_id = 'All')) {
                $product = InvoiceDetail::whereBetween('date', [$sdate, $edate])
                    ->where('status', 1)
                    ->get();
            } else {
                $product = InvoiceDetail::whereBetween('date', [$sdate, $edate])
                    ->where('category_id', $request->category_id)
                    ->where('product_id', $request->product_id)
                    ->where('status', 1)
                    ->get();
            }

            //     $start_date = date('Y-m-d',strtotime($request->start_date));
            // $end_date = date('Y-m-d',strtotime($request->end_date));
            return view('admin.pdf.product_wise_report_pdf', compact('product'));
        } else {
            $product = InvoiceDetail::where('category_id', $request->category_id)
                ->where('product_id', $request->product_id)
                ->where('status', 1)
                ->get();
            return view('admin.pdf.product_wise_report_pdf', compact('product'));
        }
    } // End Method
}
