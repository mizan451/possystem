<!DOCTYPE html>
<html>
<head>
	<title>Invoice PDF</title>
</head>
<body>
	<div class="continer">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td></td>
							<td><span style="font-size: 20px; background: #ddd">Daily Invoice Report({{'d-y-m',  strtotime(start_date)}} - {{'d-y-m',  strtotime(end_date)}})</span><br>Uttara Dhaka</td>
							<td>Mobile No.+8801763104378</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

                  <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $invoice)
                     <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$invoice['payment'] ['customer']['name']}}-{{$invoice['payment'] ['customer']['mobile_no']}}-{{$invoice['payment'] ['customer']['address']}}</td>
                       <td>Invoice No #{{$invoice->invoice_no}}</td>
                       <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                       <td>{{$invoice->description}}</td>
                     </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
              </form>
	    </div>
    </body>
</html>