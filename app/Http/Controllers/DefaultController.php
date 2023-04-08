<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
                $category_id = Product::with(['category'])
                            ->select('category_id')
                            ->distinct()
                            ->where('supplier_id',$supplier_id)
                            ->get();
                return response()->json($category_id);
        }

        public function getProduct(Request $request){
            $category_id = $request->category_id;
            $product = Product::where('category_id',$category_id)->get();
            return response()->json($product);

        }
        public function getAllProduct(){
            $product = Product::all();
            return response()->json($product);

        }

        public function checkProductStock(Request $request){
            $product_id = $request->product_id;
            $stock = Product::where('id',$product_id)->first()->quantity;
            return response()->json($stock);
        }

        public function getCatProduct(Request $request){
            $category_id = $request->category_id;
            $product = Product::where('category_id',$category_id)->get();
            return response()->json($product);

        }
}
