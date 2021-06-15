@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Add Invoice') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('invoice.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> Invoice List</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->

      <div class="card-body">
        <div class="form-row">

          <div class="form-group col-md-2">
            <label>Invoice No</label>
            <input type="text" name="invoice_no" id="invoice_no" class="form-control-sm" value="{{$invoice_no}}" readonly style="background-color: #D8FDBA">
          </div>

          <div class="form-group col-md-2">
            <label>Date</label>
            <input type="text" name="date" id="date" value="{{$date}}" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly="">
          </div>

           <div class="form-group col-md-2">
            <label for="category_id">Category Name</label>
              <select class="form-control select2" name="category_id" id="category_id"  required>
                <option value="">Select Category</option>
                              @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
              </select>  
          </div>

          <div class="form-group col-md-2">
            <label for="product_id">Product </label>
              <select class="form-control select2" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
              </select>  
          </div>
          <div class="form-group col-md-2">
            <label for="name">Stock (Psc/Kg)</label>
            <input type="text" name="current_stock_qty" id="current_stock_qty" class="form-control-sm" value="{{$invoice_no}}" readonly style="background-color: #D8FDBA">
          </div>

          <div class="form-group col-md-2">
            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
          </div>
        </div>
      </div>
            
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="{{route('invoice.store')}}" method="post" id="myForm">
                  @csrf
                  <table class="table-sm table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category </th>
                        <th>Product Name</th>
                        <th width="7%">Psc/Kg</th>
                        <th width="10%">Unit Price</th>
                        <th width="16%">Total Price</th>
                         <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">

                    </tbody>
                    <tbody>
                      <tr>
                        <td class="tex-right" style="text-align: right;" colspan="4">Discount</td>
                        <td>
                          <input type="text" name="discount_amount" id="discount_amount" class="form-control form-control-sm discount_amount" placeholder="Enter Discount Amount">
                        </td>
                      </tr>
                      <tr>
                        <td class="tex-right" style="text-align: right;" colspan="4">Total Amount</td>
                          <td>
                            <input type="text" name="f" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <textarea name="description" class="form-control" id="description" placeholder="Write description here"></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Paid Status<label>
                       <select name="paid_status" id="paid_status" class="form-control form-control">
                         <option value="">Select Status</option>
                         <option value="full_paid">Full Paid</option>
                         <option value="full_due">Full Due</option>
                         <option value="partial_paid">Partial Paid</option>
                       </select>
                       <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Amount" style="display: none; background-color: #D8FDBA">
                    </div>
                    <div class="form-group col-md-8">
                      <select name="customer_id" id="customer_id" class="form-control form-control">
                         <option value="">Select Customer</option>
                         @foreach($customers as $customer)
                         <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}})</option>
                         @endforeach
                         <option value="0">New Customer</option>
                       </select>
                    </div>
                  </div>
                  <div class="form-row  new_customer" style="display: none;">
                    <div class="form-group col-md-4">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Customer Name" style="background-color: #D8FDBA">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Customer address" style="background-color: #D8FDBA">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm" placeholder="Customer Phone No" style="background-color: #D8FDBA">
                    </div>
                  </div>
                    <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="storeButton">Invoice Store</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>

    <script id="document-template" type="text/x-handlebars-template">
      <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="date" value="@{{date}}">
      <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
     <td>
         <input type="hidden" name="category_id[]" value="@{{category_id}}">
         @{{category_name}}
     </td>
     <td>
         <input type="hidden" name="product_id[]" value="@{{product_id}}">
         @{{product_name}}
     </td>
     <td>
         <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
     </td>
     <td>
         <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
     </td>
     <td>
       <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
     </td>
     <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
  </tr>
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $(document).on("click", ".addeventmore", function() {
      var date = $('#date').val();
      var invoice_no  = $('#invoice_no').val();
      var suplier_id  = $('#suplier_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id    = $('#product_id').val();
      var product_name  = $('#product_id').find('option:selected').text();

      if (date=='') {
        $.notify("Date is required", {globalPosition: 'top right', className: 'error'});
        return false;
      }

      if (category_id=='') {
        $.notify("Category is required", {globalPosition: 'top right', className: 'error'});
        return false;
      }

      if (product_id=='') {
        $.notify("Products is required", {globalPosition: 'top right', className: 'error'});
        return false;
      }

      var source = $("#document-template").html();
      var template = Handlebars.compile(source);
      var data = {
             date:date,
             invoice_no:invoice_no,
             category_id:category_id,
             category_name:category_name,
             product_id:product_id,
             product_name:product_name
          };
          var html = template(data);
          $("#addRow").append(html);
      });
    
    $(document).on("click", ".removeeventmore", function(event){
      $(this).closest("delete_add_more_item").remove();
      totalAmountPrice();
     });

    $(document).on('keyup click', '.unit_price,.selling_qty ', function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty  = $(this).closest("tr").find("input.selling_qty ").val();
      var total = unit_price * qty;
      $(this).closest("tr").find("input.selling_price").val(total);
      $('#discount_amount').trigger('keyup');
    });

    $(document).on('keyup', '#discount_amount', function(){
         totalAmountPrice();
    });

  //Calculate sum of amount invoice
    function totalAmountPrice(){
      var sum=0;
      $(".selling_price").each(function(){
        var value = $(this).val();
        if (!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
        }
      });
       var discount_amount = parseFloat($('#discount_amount').val());
       if (!isNaN(discount_amount)&& discount_amount.length !=0) {
        sum -= parseFloat(discount_amount);
       }
      $('#estimated_amount').val(sum);
    }
  });
</script>


<script type="text/javascript">
  $(function(){
     $(document).on('change','#suplier_id',function(){
        var suplier_id = $(this).val();
        $.ajax({
             url:"{{route('get-category')}}",
             type:"GET",
             data:{suplier_id:suplier_id},
             success:function(data){
              var html ='<option value="">Select Category</option>';
              $.each(data, function(key,v){
                html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
              });
              $('#category_id').html(html);
            }
        });
     });
  });
</script>
<script>
    $(function(){
      $(document).on('change', '#product_id', function(){
        var product_id = $(this).val();
        $.ajax({
          url:"{{route('check-product-stock')}}",
          type:"GET",
          data:{product_id:product_id},
          success:function(data){
            $('#current_stock_qty').val('data');
          }
        });
      });
    });
</script>
<script>
  $(function(){
     $(document).on('change','#category_id',function(){
        var category_id = $(this).val();
        $.ajax({
             url:"{{route('get-product')}}",
             type:"GET",
             data:{category_id:category_id},
             success:function(data){
              var html ='<option value="">Select Product</option>';
              $.each(data, function(key, v){
                html +='<option value="'+v.id+'">'+v.name+'</option>';
              });
              $('#product_id').html(html);
            }
        });
     });
  });
</script>
<script>
  $(function(){
    $('.select2').select2();
  });
</script>
<script type="text/javascript">
  //paid status
  $(document).on('change','#paid_status', function(){
      var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }
  });

    $(document).on('change','#customer_id', function(){
      //paid status
      var customer_id = $(this).val();
        if (customer_id == '0') {
          $('.new_customer').show();
        }else{
          $('.new_customer').hide();
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

