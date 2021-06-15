@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Add Product') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('purchase.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> Purchase List</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->

      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Date</label>
            <input type="text" name="date" id="date" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly="">
          </div>

          <div class="form-group col-md-4">
            <label>Purchase No</label>
            <input type="text" name="purchase_no" id="purchase_no" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label for="suplier_id">Suplier Name</label>
              <select class="form-control select2" name="suplier_id" id="suplier_id"  required>
                <option value="">Select Suplier</option>
                              @foreach ($supliers as $suplier)
                <option value="{{$suplier->id}}">{{$suplier->name}}</option>
                              @endforeach
              </select>
          </div>
          <div class="form-group col-md-4">
            <label for="category_id">Category </label>
              <select class="form-control select2" id="category_id" name="category_id"  required>
              </select>
          </div>
          <div class="form-group col-md-4">
            <label for="product_id">Product </label>
              <select class="form-control select2" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
              </select>
          </div>
          <div class="form-group col-md-4">
            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
          </div>
        </div>
      </div>


      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="{{route('purchase.store')}}" method="post" id="myForm">
                  @csrf
                  <table class="table-sm table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category </th>
                        <th>Product Name</th>
                        <th width="7%">Psc/Kg</th>
                        <th width="10%">Unit Price</th>
                        <th>Description</th>
                        <th width="10%">Total Price</th>
                         <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">

                    </tbody>
                    <tbody>
                      <tr>
                        <td colspan="5"> </td>
                          <td>
                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>

    <script id="document-template" type="text/x-handlebars-template">
      <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="date[]" value="@{{date}}">
      <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
      <input type="hidden" name="suplier_id[]" value="@{{suplier_id}}">
     <td>
         <input type="hidden" name="category_id[]" value="@{{category_id}}">
         @{{category_name}}
     </td>
     <td>
         <input type="hidden" name="product_id[]" value="@{{product_id}}">
         @{{product_name}}
     </td>
     <td>
         <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
     </td>
     <td>
         <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
     </td>
     <td>
      <input name="description[]" class="form-control form-control-sm">
     </td>
     <td>
       <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
     </td>
     <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
  </tr>
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $(document).on("click", ".addeventmore", function() {
      var date = $('#date').val();
      var purchase_no = $('#purchase_no').val();
      var suplier_id  = $('#suplier_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id    = $('#product_id').val();
      var product_name  = $('#product_id').find('option:selected').text();

      if (date=='') {
        $.notify("Date is required", {globalPosition: 'top right', className: 'error'});
        return false;
      }

      if (purchase_no=='') {
        $.notify("Purchase No is required", {globalPosition: 'top right', className: 'error'});
        return false;
      }

      if (suplier_id=='') {
        $.notify("Suplier is required", {globalPosition: 'top right', className: 'error'});
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
             purchase_no:purchase_no,
             suplier_id:suplier_id,
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

    $(document).on('keyup click', '.unit_price,.buying_qty', function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty  = $(this).closest("tr").find("input.buying_qty").val();
      var total = unit_price * qty;
      $(this).closest("tr").find("input.buying_price").val(total);
      totalAmountPrice();
    });

  //Calculate sum of amount invoice
    function totalAmountPrice(){
      var sum=0;
      $(".buying_price").each(function(){
        var value = $(this).val();
        if (!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
        }
      });
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

<script>
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format:'yyyy-mm-dd'
  });
</script>

@endsection

