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
					
			</div>
		</div>
		   <!-- /.card-header -->
        <div class="card-body">
                          </div>
              
              <form method="post" action="">
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
                    @foreach($payment as $key => $details)

                    <tr class="text-center">

                      <td>{{$details['category']['name']}}</td>
                      <td>{{$details['product']['name']}}</td>
                      <td class="text-center" style="background: #ddd; padding: 1px;">{{$details['product']['quantity']}}</td>
>
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