<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        return view('backend.product.index',[
            'products' => Product::paginate(10)
        ]);
    }


    public function create()
    {
        return view('backend.product.create',[
            'supplier_info' => Supplier::all(),
            'category_info' => Category::all(),
            'unit_info' => Unit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        if($request->hasFile('image')){
            $product->image =  Storage::put('product', $request->file('image'));
        }
        $product->save();
        return redirect()->route('products.index')->with('success','Product has been successfully created');
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
