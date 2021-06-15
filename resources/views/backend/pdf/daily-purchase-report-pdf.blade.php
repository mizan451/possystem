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
							<td><span style="font-size: 20px; background: #ddd">Daily Purchase Report</span><br>Uttara Dhaka</td>
							<td>Mobile No.+8801763104378</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

                  <!-- /.card-header -->
              <div class="card-body">
                <table border="1" width="100%">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $total_sum = '0';
                    @endphp
                    @foreach($allData as $key => $purchase)
                     <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$purchase->purchase_no}}</td>
                       <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                       <td>{{$purchase['product']['name']}}</td>
                       <td>
                         {{$purchase->buying_qty}}
                         {{$purchase['product']['unit']['name']}}
                       </td>
                       <td>{{$purchase->unit_price}}</td>
                       <td>{{$purchase->buying_price}}</td>
                       @php
                           $total_sum += $purchase->buying_price;
                       @endphp
                     </tr>
                      @endforeach
                      <tr>
                        <td colspan="6" style="text-align: right;"><strong>Grand Total</strong></td>
                        <td>{{$total_sum}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
		   <!-- /.card-header -->

    </body>
</html>