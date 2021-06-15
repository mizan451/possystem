@extends('backend.layouts.app')

@section('content') 
  <div class="content-wrapper">
  <div class="continer">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tbody>
            <tr>
              
              <td><span style="font-size: 20px; background: #ddd">Mizan Shopping Mall</span><br>Uttara Dhaka</td>
              <td>Mobile No.+8801763104378</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
       <!-- /.card-header -->
    <div class="card-body">
      <table width="100%">
        <tbody>
          <tr>
            <td width="30%"><strong>Customer Name</strong> {{$payment['customer']['name']}}</td>
            <td width="30%"><strong>Mobile No</strong> {{$payment['customer']['mobile_no']}}</td>
            <td width="40%"><strong>Address</strong> {{$payment['customer']['address']}}</td>
          </tr>
          <tr>
            <td width="15%"></td>      
          </tr>
        </tbody>
        </table>
              
        <form method="post" action="{{route('customers.update.invoice', $payment->invoice_id)}}" id="myForm">
          @csrf
            <table border="1" width="100%" style="margin-bottom: 10px;">
              <thead>
                    <tr class="text-center">
                      <th>SL.</th>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <td>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $total_sum = '0';
                      $invoice_details = App\Model\InvoiceDetail::where('invoice_id', $payment->invoice_id)->get();
                    @endphp
                    @foreach($invoice_details as $key => $details)

                    <tr class="text-center">
                      <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                      <input type="hidden" name="product_id[]" value="{{$details->category_id}}">
                      <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                      <td>{{$key+1}}</td>
                      <td>{{$details['category']['name']}}</td>
                      <td>{{$details['product']['name']}}</td>
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
                      <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                      <td colspan="6" class="text-right">Due Amount</td>
                      <td>{{$payment->due_amount}}</td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right"><strong>Grand Total </strong></td>
                      <td><strong>{{$payment->total_amount}}</strong></td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="form-group col-md-3">
                      <label>Paid Status<label>
                       <select name="paid_status" id="paid_status" class="form-control form-control">
                         <option value="">Select Status</option>
                         <option value="full_paid">Full Paid</option>
                         <option value="partial_paid">Partial Paid</option>
                       </select>
                       <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Amount" style="display: none; background-color: #D8FDBA">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="text" name="date" id="date" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly="">
                    </div>
                    <div class="form-group col-md-3" style="padding-top: 30px">
                      <button type="submit" class="btn btn-primary btn-sm" >Invoice Update</button>
                    </div>
              </form>
          </div>




    <script type="text/javascript">
      $(document).on('change','#paid_status', function(){
         var paid_status = $(this).val();
          if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
          }else{
            $('.paid_amount').hide();
          }
        });
    </script>

<script>
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format:'yyyy-mm-dd'
  });
</script>

  @endsection