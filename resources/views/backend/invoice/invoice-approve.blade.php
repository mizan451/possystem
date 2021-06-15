@extends('backend.layouts.app')

@section('content') 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('invoice.pending.list')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-add"></i>Pending Invoice List</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3> Invoice No. #{{$invoice->invoice_no}} date :{{date('d-m-y', strtotime($invoice->date))}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table width="100%">
                  @php 
                    $payment = App\Model\Payment::where('invoice_id', $invoice->id)->first();
                  @endphp
                  <tbody>
                    <tr>
                      <td width="15%"><p><strong>Customer Info</strong></p></td>
                      <td width="25%"><p><strong>Name</strong> {{$payment['customer']['name']}}</p></td>
                      <td width="25%"><p><strong>Mobile No</strong> {{$payment['customer']['mobile_no']}}</p></td>
                      <td width="35%"><p><strong>Address</strong> {{$payment['customer']['address']}}</p></td>
                    </tr>
                    <tr>
                      <td width="15%"></td>
                      <td width="85" colspan="3"><p><strong>Description :  {{$payment->description}}</strong></p></td>
                    </tr>
                  </tbody>
                </table></div>
              
              <form method="post" action="{{route('approval.store', $invoice->id)}}">
                @csrf
                <table border="1" width="100%" style="margin-bottom: 10px;">
                  <thead>
                    <tr class="text-center">
                      <th>SL.</th>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <th  class="text-center" style="background: #ddd; padding: 1px;">Current Stock</th>
                      <td>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                         $total_sum = '0';
                    @endphp
                    @foreach($invoice['InvoiceDetails'] as $key => $details)

                    <tr class="text-center">
                      <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                      <input type="hidden" name="product_id[]" value="{{$details->category_id}}">
                      <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                      <td>{{$key+1}}</td>
                      <td>{{$details['category']['name']}}</td>
                      <td>{{$details['product']['name']}}</td>
                      <td class="text-center" style="background: #ddd; padding: 1px;">{{$details['product']['quantity']}}</td>
                      <td>{{$details->selling_qty}}</td>
                      <td>{{$details->unit_price}}</td>
                      <td>{{$details->selling_price}}</td>
                    </tr>
                    @php
                      $total_sum += $details->selling_price;
                    @endphp
                    @endforeach
                    <tr>
                      <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                      <td><strong>{{$total_sum}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Discount</td>
                      <td>{{$payment->discount_amount}}</td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Paid Amount</td>
                      <td>{{$payment->paid_amount}}</td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Due Amount</td>
                      <td>{{$payment->due_amount}}</td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right"><strong>Grand Total </strong></td>
                      <td><strong>{{$payment->total_amount}}</strong></td>
                    </tr>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success">Invoice Approve</button>
              </form>
            </div>
            <!-- /.card -->
          </div>
      <!-- /.container-fluid -->
      </section>
    </div>
  </div>
  @endsection('content') 