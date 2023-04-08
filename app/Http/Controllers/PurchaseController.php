<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;

class PurchaseController extends Controller
{

    public function index()
    {
        return view('backend.purchase.index',[
            'purchases' => Purchase::paginate(10)
        ]);
    }


    public function create()
    {
        $purchase = Purchase::select('purchase_no')->orderBy('id','desc')->first();
        if($purchase){
            $purchase_no = str_pad($purchase->purchase_no + 1, 5, '0', STR_PAD_LEFT);
        }else{
            $purchase_no = str_pad(1, 5, '0', STR_PAD_LEFT);;;
        }
        return view('backend.purchase.create',[
            'suppliers' => Supplier::all(),
            'categories' => Category::all(),
            'units' => Unit::all(),
            'purchase_info' => Purchase::all(),
            'purchase_no' => $purchase_no
        ]);
    }

    public function store(Request $request)
    {
           // return $request->all();
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry! You did not select any item');
        }else{
            $count_category = count($request->category_id);
            for($i = 0; $i < $count_category; $i++){
                $purchase = new Purchase();
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->purchase_date = date('Y-m-d',strtotime($request->purchase_date[$i]));
                $purchase->description = $request->description[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->status = '0';
                $purchase->created_by = auth()->user()->id;
                if($purchase->save()){
                   $this->updateProductStock($purchase->product_id , $purchase->buying_qty);
                }
            }
        }
        return redirect()->route('purchases.index')->with('success','Purchase data saved successfully');
}

    private function updateProductStock($productId , $qty){
        $product = Product::select('quantity')->where('id' , $productId)->first();
        if($product){
            $totalQty = 0;
            if($product->quantity > 0){
                $totalQty = $product->quantity + $qty;
            }else{
                $totalQty = $qty;
            }

            Product::where('id' , $productId)->update(['quantity' => $totalQty]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
