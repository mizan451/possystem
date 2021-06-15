<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Suplier;
use App\Model\Unit;
use App\Model\Product;
use Auth;

class ProductController extends Controller
{
   public function view(){
    	$allData = Product::all();
        
    	return view('backend.product.view-product',compact('allData') );
    }

    public function add(){
        $data['supliers']=Suplier::all();
        $data['units']=Unit::all();
        $data['categories']=Category::all();
    	return view('backend.product.add-product', $data);
    }

    public function store(Request $request){
    	$product = new Product();
        $product->suplier_id = $request->suplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
    	$product->name = $request->name;
    	$product->created_by = Auth::user()->id;
    	$product->save();
    	return redirect()->route('products.view')->with('success', 'product Added Successfully!!');
    }

    public function edit($id){
    	$data['editData'] = Product::find($id);
        $data['supliers']=Suplier::all();
        $data['units']=Unit::all();
        $data['categories']=Category::all();
    	return view('backend.product.edit-product', $data);
    }

    public function update(Request $request, $id){
    	$product = Product::find($id);
    	$product->name = $request->name;
    	$product->updated_by = Auth::user()->id;
    	$product->save();
    	return redirect()->route('products.view')->with('success', 'Product Updated Successfully!!');
    }

    public function delete($id){
    	$product = Product::find($id);
    	$product->delete();
    	return redirect()->route('products.view')->with('success', 'Product Delete Successfully!!');
    }
}
