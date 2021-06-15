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
                     <strong>Customer Wise Creadit Report</strong>
                   <input type="radio" name="customer_wise_report" value="customer_wise_credite" class="search_value"> &nbsp;&nbsp;

                   <strong>Customer Wise Paid Report</strong>
                   <input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value"> 
                   </div>
                 </div>

                 <div class="show_credit" style="display: none;">
                   <form method="GET" action="{{route('customers.wise.credit.report')}}"  terget="_blank" id="custmerCreditForm">
                     <div class="form-row">
                      <div class="col-sm-6">
                       <label>Customer Name</label>
                       <select name="customer_id" class="form-control select2 ">
                         <option value="">Select Customer</option>
                         @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                         @endforeach
                       </select>
                     </div>
                     <div class="col-sm-4" style="padding-top: 32px;">
                       <button type="submit" class="btn btn-primary btn-sm">Search</button>
                     </div>
                     </div>
                   </form>
                 </div>

                 <div class="show_paid" style="display: none;">
                   <form method="GET" action="{{route('customers.wise.report')}}"  terget="_blank" id="custmerPaidForm">
                     <div class="form-row">
                        <label>Customer Name</label>
                       <select name="customer_id" class="form-control select2 ">
                         <option value="">Select Customer</option>
                         @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                         @endforeach
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
       if (search_value == 'customer_wise_credite') {
        $('.show_credit').show();
       }else{
        $('.show_credit').hide();
       }

       if (search_value == 'customer_wise_paid') {
        $('.show_paid').show();
       }else{
        $('.show_paid').hide();
       }
    })
  </script>
   
   <script type="text/javascript">
     $(document).ready(function () {
      $('#custmerCreditForm').validate({
        ignore:[],
        errorPlacement: function(error, element){
          if (element.attr("name") == "customer_id") { error.insertAfter(
            element.next()); }  
            else{error.insertAfter(element); }
        },
        errorClass: 'text-danger',
        validClass: 'text-success',
        rules: {
          customer_id: {
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

  @endsection