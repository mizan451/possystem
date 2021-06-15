@extends('backend.layouts.app')

@section('content') 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('stock.report.pdf')}}" terget="_blank" class="btn btn-block btn-success btn-lg"><i class="fa fa-download"></i> Download Pdf</a>
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
                <h3 class="card-title">Select Criteria</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="row">
                   <div class="col-sm-12" text-center>
                     <strong>Suplier Wise Report</strong>
                   <input type="radio" name="suplier_product_wise" value="suplier_wise" class="search_value"> &nbsp;&nbsp;

                   <strong>Product Wise Report</strong>
                   <input type="radio" name="suplier_product_wise" value="product_wise" class="search_value"> 
                   </div>
                 </div>

                 <div class="show_suplier" style="display: none;">
                   <form method="GET" action="{{route('stock.report.suplier.wise.pdf')}}"  terget="_blank" id="suplierWiseForm">
                     <div class="form-row">
                       <div class="col-sm-6">
                       <label>Suplier Name</label>
                       <select name="suplier_id" class="form-control select2 ">
                         <option value="">Select Suplier</option>
                         @foreach($suppliers as $supplier)
                         <option value="{{$supplier->id}}"> {{$supplier->name}}</option>
                         @endforeach
                       </select>
                     </div>
                     <div class="col-sm-4" style="padding-top: 32px;">
                       <button type="submit" class="btn btn-primary btn-sm">Search</button>
                     </div>
                     </div>
                   </form>
                 </div>

                 <div class="show_product" style="display: none;">
                   <form method="GET" action="{{route('stock.report.product.wise.pdf')}}"  terget="_blank" id="productWiseForm">
                     <div class="form-row">
                        <div class="form-group col-sm-6">
                           <label for="category_id">Category Name</label>
                              <select class="form-control select2" name="category_id" id="category_id"  required>
                                  <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                             </select>  
                        </div>

                        <div class="form-group col-sm-4">
                        <label for="product_id">Product </label>
                        <select class="form-control select2" id="product_id" name="product_id" required>
                          <option value="">Select Product</option>
                         </select>  
                        </div>
                     <div class="col-sm-2" style="padding-top: 32px;">
                       <button type="submit" class="btn btn-primary btn-sm">Search</button>
                     </div>
                     </div>
                   </form>
                 </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).on('change', '.search_value', function(){
      var search_value = $(this).val();
       if (search_value == 'suplier_wise') {
        $('.show_suplier').show();
       }else{
        $('.show_suplier').hide();
       }

       if (search_value == 'product_wise') {
        $('.show_product').show();
       }else{
        $('.show_product').hide();
       }
    })
  </script>
   
   <script type="text/javascript">
     $(document).ready(function () {
      $('#suplierWiseForm').validate({
        ignore:[],
        errorPlacement: function(error, element){
          if (element.attr("name") == "suplier_id") { error.insertAfter(
            element.next()); }  
            else{error.insertAfter(element); }
        },
        errorClass: 'text-danger',
        validClass: 'text-success',
        rules: {
          suplier_id: {
            required: true,
          }
        },
        message: {

        }
      })
     })
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
  @endsection