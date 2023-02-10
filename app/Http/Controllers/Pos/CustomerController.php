<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Carbon;
use Image;
use App\Models\Payment;
use App\Models\PaymentDetail;

class CustomerController extends Controller
{
    public function index(){

         $customers = Customer::latest()->get();
        return view('admin.customers.index',compact('customers'));

    } // End Method


    public function create(){
     return view('admin.customers.create');
    }    // End Method


    public function store(Request $request){

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'customer_image' => $save_url ,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

    } // End Method


    public function edit($id){

       $customer = Customer::findOrFail($id);
       return view('admin.customers.edit',compact('customer'));

    } // End Method


    public function update(Request $request){

        $customer_id = $request->id;
        if ($request->file('customer_image')) {

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'customer_image' => $save_url ,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Updated with Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } else{

          Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Updated without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } // end else

    } // End Method


    public function destroy($id){

        $customers = Customer::findOrFail($id);
        $img = $customers->customer_image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    public function credit(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customers.credit',compact('allData'));

    } // End Method


    public function creditPrintPdf(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.pdf.customer_credit_pdf',compact('allData'));

    }// End Method



    public function editInvoice($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.customers.edit_invoice',compact('payment'));

    }// End Method


    public function updateInvoice(Request $request,$invoice_id){

        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
            'message' => 'Sorry You Paid Maximum Value',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        } else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                 $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                 $payment->due_amount = '0';
                 $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

              $notification = array(
            'message' => 'Invoice Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('credit.customer')->with($notification);


        }

    }// End Method



    public function invoiceDetails($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.pdf.invoice_details_pdf',compact('payment'));

    }// End Method

    public function paid(){
        $allData = Payment::with(['invoice','customer'])->where('paid_status','!=','full_due')->get();
        return view('admin.customers.paid',compact('allData'));
    }// End Method

    public function paidPrintPdf(){

        $allData = Payment::with(['invoice','customer'])->where('paid_status','!=','full_due')->get();
        return view('admin.pdf.customer_paid_pdf',compact('allData'));
    }// End Method


    public function wiseReport(){

        $customers = Customer::all();
        return view('admin.customers.wise_report',compact('customers'));

    }// End Method


    public function wiseCreditReport(Request $request){

         $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.pdf.customer_wise_credit_pdf',compact('allData'));
    }// End Method


    public function wisePaidReport(Request $request){

         $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        return view('admin.pdf.customer_wise_paid_pdf',compact('allData'));
    }// End Method



}
