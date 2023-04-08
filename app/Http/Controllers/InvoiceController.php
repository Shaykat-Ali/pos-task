<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\DB;
use App\Models\InvoiceDetails;

class InvoiceController extends Controller
{

    public function index()
    {
        return view('backend.invoice.index',[
            'invoice_info' => Invoice::orderBy('id','desc')->paginate(10)
        ]);
    }


    public function create()
    {

        $purchase = Invoice::select('invoice_no')->orderBy('id','desc')->first();
        if($purchase){
            $invoice_no = str_pad($purchase->invoice_no + 1, 5, '0', STR_PAD_LEFT);
        }else{
            $invoice_no = str_pad(1, 5, '0', STR_PAD_LEFT);;;
        }

        return view('backend.invoice.create',[
            'categories' => Category::all(),
            'invoice_no' => $invoice_no,
            'selling_date' => date('Y-m-d'),
            'customers' => Customer::all(),
        ]);
    }


    public function store(Request $request)
    {
        if($request->product_id == null) {
            return redirect()->back()->with('error','Sorry! you do not select any product');
    } else {
        if($request->paid_amount > $request->estimated_amount) {
            return redirect()->back()->with('error','Sorry! you entered paid amount is greater than total amount');
        } else {
            $invoice = new Invoice();
            $invoice->invoice_no = $request->invoice_no;
            $invoice->date = date('Y-m-d',strtotime($request->date));
            $invoice->description = $request->description;
            $invoice->status = '0';
            $invoice->created_by = auth()->user()->id;
            DB::transaction(function() use($invoice,$request){
                if($invoice->save()){
                    $count_category = count($request->category_id);
                    for($i = 0; $i < $count_category; $i++){
                      $invoice_details = new InvoiceDetails();
                      $invoice_details->date = date('Y-m-d',strtotime($request->date));
                      $invoice_details->invoice_id = $invoice->id;
                      $invoice_details->category_id = $request->category_id[$i];
                      $invoice_details->product_id = $request->product_id[$i];
                      $invoice_details->selling_qty = $request->selling_qty[$i];
                      $invoice_details->unit_price = $request->unit_price[$i];
                      $invoice_details->selling_price = $request->selling_price[$i];
                      $invoice_details->description = $request->description;
                      $invoice_details->status = '0';
                      $invoice_details->save();
                      $this->updateProductStock( $invoice_details->product_id, $invoice_details->selling_qty);
                    }

                    if($request->customer_id == '0'){
                       $customer = new Customer();
                       $customer->customer_name = $request->customer_name;
                       $customer->mobile_no = $request->mobile_no;
                       $customer->address = $request->address;
                       $customer->save();
                       $customer_id = $customer->id;
                    }else {
                       $customer_id = $request->customer_id;
                    }

                    $payment = new payment();
                    $payment_details = new PaymentDetails();
                    $payment->invoice_id = $invoice->id;
                    $payment->customer_id = $customer_id;
                    $payment->paid_status = $request->paid_status;
                    $payment->total_amount = $request->estimated_amount;
                    $payment->discount_amount = $request->discount_amount;
                    if($request->paid_status == 'full_paid'){
                        $payment->paid_amount = $request->estimated_amount;
                        $payment->due_amount = '0';
                        $payment_details->current_paid_amount = $request->estimated_amount;
                    }elseif($request->paid_status == 'full_due'){
                        $payment->paid_amount = '0';
                        $payment->due_amount = $request->estimated_amount;
                        $payment_details->current_paid_amount = '0';
                    }elseif($request->paid_status == 'partial_paid'){
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                        $payment_details->current_paid_amount = $request->paid_amount;
                    }

                    $payment->save();
                    $payment_details->invoice_id = $invoice->id;
                    $payment_details->date = date('Y-m-d',strtotime($request->date));
                    $payment_details->save();
                }
            });
        }
    }
    return redirect()->route('invoices.index')->with('success','Data Stored Successfully');
    }
    private function updateProductStock($productId , $qty){
        $product = Product::select('quantity')->where('id' , $productId)->first();
        if($product){
            $totalQty = 0;
            if($product->quantity > 0){
                $totalQty = $product->quantity - $qty;
            }else{
                $totalQty = 0 - $qty;
            }

            Product::where('id' , $productId)->update(['quantity' => $totalQty]);
        }

    }



    public function show($id)
    {
        return view('backend.invoice.show',[
            'invoice' => Invoice::with(['invoiceDetails'])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
