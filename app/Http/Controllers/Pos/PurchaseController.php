<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    public function PurchaseAll(){

        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('admin.purchases.index',compact('allData'));

    } // End Method


    public function PurchaseAdd(){

        $category = Category::all();
        return view('admin.purchases.create',compact('category'));

    } // End Method


    public function PurchaseStore(Request $request){

    if ($request->category_id == null) {

       $notification = array(
        'message' => 'Sorry you do not select any item',
        'alert-type' => 'error'
    );
    return redirect()->back( )->with($notification);
    } else {

        $count_category = count($request->category_id);
        for ($i=0; $i < $count_category; $i++) {
            $purchase = new Purchase();
            $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
            $purchase->purchase_no = $request->purchase_no[$i];
            $purchase->category_id = $request->category_id[$i];
            $purchase->product_id = $request->product_id[$i];
            $purchase->buying_qty = $request->buying_qty[$i];
            $purchase->description = $request->description[$i];

            $purchase->created_by = Auth::user()->id;
            $purchase->status = '0';
            $purchase->save();
        } // end foreach
    } // end else

    $notification = array(
        'message' => 'Data Save Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('purchase.all')->with($notification);
    } // End Method


    public function PurchaseEdit($id){
        $category = Category::all();
        $product = Product::all();
        $purchase = Purchase::findOrFail($id);
        return view('admin.purchases.edit',compact('product','category','purchase'));

    }

    public function PurchaseUpdate(Request $request){

if ($request->category_id == null) {
    $notification = array(
    'message' => 'Sorry you have not select any item',
    'alert-type' => 'error'
            );
    return redirect()->back()->with($notification);
}
            else if ($request->product_id == null) {
                $notification = array(
                'message' => 'Sorry you have not select any item',
                'alert-type' => 'error'
            );
            return redirect()->back( )->with($notification);
        } else {
              $purchase_id = $request->id;
            Purchase::findOrFail($purchase_id)->update([
                'date'=>date('Y-m-d', strtotime($request->date)),'purchase_no'=>$request->purchase_no,'category_id'=>$request->category_id,'product_id'=>$request->product_id,'buying_qty'=>$request->buying_qty,'description'=>$request->description,
                'created_by'=>Auth::user()->id,
            ]);

        } // end else

        $notification = array(
            'message' => 'Data Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification);
    } // End Method

    public function PurchaseDelete($id){

        Purchase::findOrFail($id)->delete();

         $notification = array(
        'message' => 'Purchase Item Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

    } // End Method


    public function PurchasePending(){

        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('admin.purchases.pending',compact('allData'));
    }// End Method


    public function PurchaseApprove($id){

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

             $notification = array(
        'message' => 'Status Approved Successfully',
        'alert-type' => 'success'
          );
          return redirect()->back( )->with($notification);
    //      return redirect()->route('purchase.all')->with($notification);

        }

    }// End Method


    public function DailyPurchaseReport(){
        return view('admin.purchases.daily_report');
    }// End Method


    public function DailyPurchasePdf(Request $request){

        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('admin.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));

    }// End Method




}
