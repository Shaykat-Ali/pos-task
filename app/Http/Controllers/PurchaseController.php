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
        return view('backend.purchase.index');
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
        //
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
