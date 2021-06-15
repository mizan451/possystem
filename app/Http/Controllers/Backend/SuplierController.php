<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Suplier;
use Auth;

class SuplierController extends Controller
{
    public function view()
    {
    	$allData = Suplier::all();
    	return view('backend.suplier.view-suplier', compact('allData'));
    }

    public function add(){
    	return view('backend.suplier.add-suplier');
    }

    public function store(Request $request)
    {
    	$suplier = new Suplier();
    	$suplier->name = $request->name;
    	$suplier->mobile_no = $request->mobile_no;
    	$suplier->email = $request->email;
    	$suplier->address = $request->address;
    	$suplier->created_by = Auth::user()->id;
    	$suplier->save();
    	return redirect()->route('supliers.view')->with('success', 'Suplier Added Successfully!!');
    }

    public function edit($id)
    {
    	$editData = Suplier::find($id);
    	return view('backend.suplier.edit-suplier', compact('editData'));
    }

    public function update(Request $request, $id)
    {
    	$suplier = Suplier::find($id);
    	$suplier->name = $request->name;
    	$suplier->mobile_no = $request->mobile_no;
    	$suplier->email = $request->email;
    	$suplier->address = $request->address;
    	$suplier->updated_by = Auth::user()->id;
    	$suplier->save();
    	return redirect()->route('supliers.view')->with('success', 'Suplier Updated Successfully!!');
    }

    public function delete($id)
    {
    	$suplier = Suplier::find($id);
    	$suplier->delete();
    	return redirect()->route('supliers.view')->with('success', 'Suplier Delete Successfully!!');
    }
}
