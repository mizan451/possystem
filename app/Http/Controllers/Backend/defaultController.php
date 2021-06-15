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

class defaultController extends Controller
{
    public function getCategory(Request $request){
        $suplier_id = $request->suplier_id;
        $allCategory = Product::with(['category'])->select('category_id')->where('suplier_id',$suplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    }

    public function getProduct(Request $request){
    	 $category_id = $request->category_id;
    	 $allProduct = Product::where('category_id', $category_id)->get();
    	 return response()->json($allProduct);
    }

    public function getStock(Request $request){
            $prduct_id = $request->product_id;
            $stock = Product::where('id', $product_id)->first()->quantity;
            return response()->json($stock);
    }
}

