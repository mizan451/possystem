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
							<td><span style="font-size: 20px; background: #ddd">Product Wise Pdf </span><br>Uttara Dhaka</td>
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
                    <th>Suplier Name</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td>{{$product['suplier']['name']}}</td>
                       <td>{{$product['category']['name']}}</td>
                       <td>{{$product->name}}</td>
                       <td>{{$product->quantity}}</td>
                       <td>{{$product['unit']['name']}}</td>
                     </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
		   <!-- /.card-header -->
    </body>
</html>